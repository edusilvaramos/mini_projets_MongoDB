<?php

session_start();

require __DIR__ . '/vendor/autoload.php';

use App\Connection\Connection;
use App\Controller\HomeController;

$ctrl   = $_GET['ctrl']   ?? 'home';
$action = $_GET['action'] ?? 'index';

// create the controller class name
$ctrlClass = 'App\\Controller\\' . ucfirst($ctrl) . 'Controller';

// If the controller doesn't exist, use the home controller 
if (!class_exists($ctrlClass)) {
    $ctrlClass = HomeController::class;
    $action    = 'index';
}

// conection to mongo
$connection = new Connection();

// create the controller
$controller = new $ctrlClass($connection);

// If the action doesn't exist, use the index action
if (!method_exists($controller, $action)) {
    $action = 'index';
}

// call the action
$controller->$action();
