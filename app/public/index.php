<?php
$action = str_replace('/', '', $_SERVER['REQUEST_URI']);
if (preg_match("/[^a-z0-9-]/i", $action)){
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404</h1>";
    exit();
}


$registered = false;
if (!$registered && $action != 'login') {
    header("Location: /login");
}

$viewsFolder = __DIR__.'/../views/';
if (!file_exists($viewsFolder. $action . '.php')){
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404</h1>";
    exit();
}

include ($viewsFolder . $action . '.php');
