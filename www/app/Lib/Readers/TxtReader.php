<?php

namespace App\Lib\Readers;

class TxtReader implements ReaderInterface
{
    protected $file;

    public function __construct($fileName)
    {
        $bookFolder = __DIR__ . '/../../../storage/books/';
        $this->file = fopen($bookFolder . $fileName, 'r');
    }

    public function rows()
    {
        while (!feof($this->file)) {
            $row = fgets($this->file);
            yield $row;
        }
        return;
    }
}
