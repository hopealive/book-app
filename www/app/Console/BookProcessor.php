<?php

namespace App\Console;

use Illuminate\Database\Eloquent\Model;
use App\Entities\Book;
use App\Entities\BookContent;
use App\Entities\BookRow;
use App\Entities\Database;
use App\Lib\Readers\TxtReader;

class BookProcessor
{

    /**
     * Store new user
     */
    public function handle()
    {
        $book = Book::where('status', Book::BOOK_STATUS_WAITING_START)->limit(1)->lockForUpdate()->first();
        if (empty($book)) return;
        $book->status = Book::BOOK_STATUS_PROCESS;
        $book->save();

        $connection = (new BookRow())->getConnection();
        $connection->beginTransaction();

        $txt = new TxtReader($book->filename);

        $errors = [];
        $i = 0;
        foreach ($txt->rows() as $row) {
            ++$i;
            $row = trim($row);
            $hash = md5($row);

            $exists = BookContent::select('id')->where('hash', $hash)->first();
            if ($exists) {
                $rowId = $exists->id;
            } else {
                $content = BookContent::create([
                    'hash' => $hash,
                    'content' => $row,
                ]);
                $rowId = $content->id;
            }
            if (empty($rowId)) {
                $errors[] = 'Error while saving content';
                $connection->rollBack();
            }

            $result = BookRow::create([
                'book_id' => $book->id,
                'row_id'  => $rowId,
                'order' => $i,
            ]);
            if (!$result) {
                $errors[] = 'Error while saving book row';
                $connection->rollBack();
            }
        }
        $connection->commit();

        $book->status = empty($errors) ? Book::BOOK_STATUS_SUCCESS : Book::BOOK_STATUS_FAIL;
        $book->save();

        echo "Book saved with status: " . $book->status . "\n";
    }
}
