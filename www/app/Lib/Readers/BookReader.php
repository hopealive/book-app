<?php

namespace App\Lib\Readers;

use App\Entities\Book;

class BookReader implements ReaderInterface
{
    private $_raw;

    public function __construct($id)
    {
        $connection = (new Book())->getConnection();
        $query = 'SELECT c.content FROM book_rows r
            LEFT JOIN book_contents c ON c.id = r.row_id
            WHERE book_id = ?';
        $this->_raw = $connection->select($query, [$id]);
    }

    public function rows()
    {
        foreach ($this->_raw as $row) {
            $content = $row->content;
            yield $content;
        }
        return;
    }
}
