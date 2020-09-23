<?php
session_start();
error_reporting(0);
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AppController;
use App\Controllers\ErrorsController;
use App\Entities\Database;


new Database();

$controller = new AppController();
$action = str_replace('/', '', $_SERVER['REQUEST_URI']);

if(strpos($action, '?') !== false) {
    $request = explode('?', $action);
    $action = $request[0] ?? 'index';
}

if (empty($action)) $action = 'index';
if (!empty($action) && preg_match("/[^a-z0-9-]/i", $action)) {
    (new ErrorsController())->error404();
    exit();
}

if (method_exists($controller, $action)) {
    $controller->$action();
    exit();
}
(new ErrorsController())->error404();
