<?php

namespace App\Controllers;

class ErrorsController
{
    private $_viewsFolder = __DIR__ . '/../../views/';

    public function error404()
    {
        header("HTTP/1.1 404 Not Found");
        if (!file_exists($this->_viewsFolder . '404.php')) {
            die('404');
        }
        include($this->_viewsFolder . '404.php');
    }

    public function error401()
    {
        header("HTTP/1.1 401 Unauthorized");
        if (!file_exists($this->_viewsFolder . '401.php')) {
            die('401');
        }
        include($this->_viewsFolder . '401.php');
    }
}
