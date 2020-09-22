<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use App\Middleware\Auth;

class AppController
{
    private $user = [],
        $_viewsFolder = __DIR__ . '/../../views/';

    public function __construct()
    {
        $this->user = (new UserRepository)->getUserById((int)$_SESSION['userId']);
    }

    public function index()
    {
        $action = 'home';
        $viewsFolder = __DIR__ . '/../../views/';
        if (!file_exists($viewsFolder . $action . '.php')) {
            header("HTTP/1.0 404 Not Found");
            echo "<h1>404</h1>";
            exit();
        }
        $isRegistered = !empty($this->user);
        include($viewsFolder . $action . '.php');
    }

    /**
     * Authenticate user
     */
    public function login()
    {
        if (!empty($this->user)) {
            header("Location: /");
            exit();
        }

        if (!empty($_POST)) {
            $auth = new Auth();
            $auth->login();
        }
        include($this->_viewsFolder . 'login.php');
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


    public function error404()
    {
        header("HTTP/1.0 404 Not Found");
        include($this->_viewsFolder . '404.php');
    }
}
