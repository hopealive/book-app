<?php

namespace App\Controllers;

use App\Entities\Book;
use App\Entities\BookRow;
use App\Lib\BookFile;
use App\Lib\Readers\BookReader;
use App\Repositories\UserRepository;
use App\Middleware\Auth;
use App\Lib\View;

use Carbon\Carbon;
use Exception;

class AppController
{
    private $user = [];

    public function __construct()
    {
        $userId = (int) $_SESSION['userId'] ?? 0;
        $this->user = (new UserRepository)->getUserById($userId);
    }

    public function index()
    {
        View::render('home', ['user' => $this->user, 'isRegistered' => !empty($this->user)]);
    }

    public function library()
    {
        if (empty($this->user)) {
            header("Location: /401");
            exit();
        }
        $errors = $_SESSION['errors'] ?? '';
        unset($_SESSION['errors']);
        $books = Book::where('user_id', $this->user['id'])->get();
        View::render('library', compact('books', 'errors'));
    }

    public function read()
    {
        $id = $_GET['id'] ?? 0;
        if (empty($id) || empty($this->user)) {
            header("Location: /401");
            exit();
        }
        $books = Book::where('user_id', $this->user['id'])->get();
        $book = $books->find($id);
        if (empty($book)) {
            header("Location: /401");
            exit();
        }

        $countRows = BookRow::where('book_id', $id)->count();

        $connection = (new Book())->getConnection();
        $query = 'SELECT c.content FROM book_rows r
            LEFT JOIN book_contents c ON c.id = r.row_id
            WHERE book_id = ?
            ORDER BY r.order ASC
            LIMIT 100';
        $content = $connection->select($query, [$id]);

        View::render('library', compact('books', 'book', 'content', 'countRows'));
    }

    public function more()
    {
        $id = $_GET['id'] ?? 0;
        if (empty($id) || empty($this->user)) {
            header("Location: /401");
            exit();
        }

        $book = Book::find($id);
        if (empty($book) || $book->user_id != $this->user['id']) {
            header("Location: /401");
            exit();
        }

        $content = new BookReader($id);

        header("Content-Type: text/plain");
        foreach ($content->rows() as $row) {
            echo $row . "\n";
        }
    }

    /**
     * Save and process upload file
     */
    public function upload()
    {
        if (empty($this->user)) {
            header("Location: /401");
            exit();
        }

        $errors = [];
        if (!empty($_FILES) && !empty($_FILES['book'])) {
            $bookFile = new BookFile($_FILES['book']);
            $validation = $bookFile->validate();
            if (empty($validation['success'])) {
                $errors[] = $validation['message'] ?? 'Wrong file';
            }
            try {
                $result =  $bookFile->save();
                if (!$result) $errors[] = 'Error while saving file';
            } catch (Exception $e) {
                $errors[] = 'Critical error while saving file';
            }
            if (empty($errors)) {
                $exists = Book::where('name', $bookFile->getName())->count();
                $name = $bookFile->getName();
                if ($exists) $name .= ' (' . Carbon::now()->format('Y-m-d H:i:s') . ')';
                Book::firstOrCreate([
                    'user_id' => $this->user['id'],
                    'name' => $name,
                    'filename' => $bookFile->getFileName(),
                    'status' => Book::BOOK_STATUS_WAITING_START,
                ]);
            }
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = implode(',', $errors);
        }
        View::render('upload');
    }

    /**
     * Authenticate user
     */
    public function login()
    {
        if (!empty($_POST)) {
            $this->user = (new Auth())->login();
        }

        if (!empty($this->user)) {
            header("Location: /");
            exit();
        }
        $errors = $_SESSION['errors'] ?? '';
        unset($_SESSION['errors']);
        View::render('login', compact('errors'));
    }

    /**
     * Logout
     */
    public function logout()
    {
        (new Auth())->logout();
        header("Location: /");
        exit();
    }
}
