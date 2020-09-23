<?php

namespace App\Console;

use Illuminate\Database\Eloquent\Model;
use App\Entities\Book;
use App\Entities\Database;

class BookProcessor
{

    public function __construct()
    {
    }

    /**
     * Store new user
     */
    public function handle()
    {
        $book = Book::where('status', Book::BOOK_STATUS_WAITING_START)->limit(1)->lockForUpdate()->first();
        if(empty($book)) return;
        $book->status = Book::BOOK_STATUS_PROCESS;
        $book->save();


        $book->status = Book::BOOK_STATUS_SUCCESS;
        $book->save();
    }
}
