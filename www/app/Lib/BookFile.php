<?php

namespace App\Lib;

use Exception;

class BookFile
{
    private $_name = "",
        $_fileName = "",
        $fileData = [];

    public function __construct(array $fileData)
    {
        $this->fileData = $fileData;
        $this->_name = $fileData['name'] ?? '';
    }

    public function getName(){
        return $this->_name;
    }

    public function getFileName(){
        return $this->_fileName;
    }

    public function validate() : array
    {
        if ($this->fileData['type'] != 'text/plain') {
            return ['success' => false, 'message' => 'Wrong file type'];
        }
        if(!$this->fileData['size']){
            return ['success' => false, 'message' => 'File cannot be empty'];
        }
        return ['success' => true];
    }

    public function save() : bool
    {
        try {
            $uploadDir = __DIR__.'/../../storage/books/';
            $this->_fileName = md5( date("Ymhis"). $this->fileData['name']).'.txt';
            $uploadFile = $uploadDir . $this->_fileName;
            $result = move_uploaded_file($this->fileData['tmp_name'], $uploadFile);
            if(!$result) return false;
        } catch (Exception $e){
            return false;
        }
        return true;
    }
}
