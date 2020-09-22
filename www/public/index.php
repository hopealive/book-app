<?php
session_start();
require_once __DIR__.'/../vendor/autoload.php';

use App\Controllers\AppController;

$controller = new AppController();
$action = str_replace('/', '', $_SERVER['REQUEST_URI']);
if(empty($action)) $action = 'index';
if (!empty($action) && preg_match("/[^a-z0-9-]/i", $action)){
    $controller->error404();
    exit();
}

if (method_exists($controller, $action)){
    $controller->$action();
    exit();
}
$controller->error404();


