<?php
require __DIR__ . '/vendor/autoload.php';

session_start();

$ctrl   = $_GET['ctrl']   ?? 'home';
$action = $_GET['action'] ?? 'index';

$controllerClass = "App\\Controller\\" . ucfirst($ctrl) . "Controller";

if (!class_exists($controllerClass)) {
    die("Controller $controllerClass not found");
}

$controller = new $controllerClass();

if (!method_exists($controller, $action)) {
    die("the action $action not found in $controllerClass");
}

$controller->$action();
