<?php
session_start();
require_once __DIR__.'/../vendor/autoload.php';



######## ROUTING
$action = str_replace('/', '', $_SERVER['REQUEST_URI']);
if (!empty($action) && preg_match("/[^a-z0-9-]/i", $action)){
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404</h1>";
    exit();
}

//check for auth
$registered = false;
if (!$registered && $action != 'login') {
    header("Location: /login");
}

######## INIT VIEW
$viewsFolder = __DIR__.'/../views/';
if (!file_exists($viewsFolder. $action . '.php')){
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404</h1>";
    exit();
}

include ($viewsFolder . $action . '.php');
