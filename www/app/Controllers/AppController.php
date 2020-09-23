<?php

namespace App\Controllers;

use App\Entities\Book;
use App\Lib\BookFile;
use App\Repositories\UserRepository;
use App\Middleware\Auth;
use App\Lib\View;
use Exception;

class AppController
{
    private $user = [];

    public function __construct()
    {
        $this->user = (new UserRepository)->getUserById((int)$_SESSION['userId']);
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
        $_SESSION['errors'] = '';
        $books = Book::where('user_id', $this->user['id'])->get();
        View::render('library', compact('books', 'errors'));
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
                $errors[] = 'Error while saving file';
            }
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = implode(',', $errors);
            header("Location: /library");
            exit();
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
        View::render('login');
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
