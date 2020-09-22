<?php

namespace App\Http\Middleware;

use M1\Env\Parser;
use Predis\Client as Redis;

class Auth
{
    public function isAuthorized()
    {


        var_dump ( $_COOKIE['PHPSESSID'] );//todo:
        die;//todo:

    }
}