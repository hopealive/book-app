<?php

namespace App\Controllers;

use App\Lib\View;

class ErrorsController
{
    public function error404()
    {
        header("HTTP/1.1 404 Not Found");
        View::render('404');
    }

    public function error401()
    {
        header("HTTP/1.1 401 Unauthorized");
        View::render('401');
    }
}
