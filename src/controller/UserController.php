<?php

require __DIR__ . '/vendor/autoload.php';

use App\Connection\Connection;
use MongoDB\BSON\UTCDateTime;

$db  = new Connection();
$colUser = $db->selectCollection('user');

// criar o CRUD do user
// create user
if (isset($_POST['create'])) {
    $colUser->insertOne([
        'name' => trim($_POST['name'] ?? 'No Name'),
        'email' => $_POST['email'] ?? null,
        'password'=> $_POST['password'] ?? null,
    ]);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

echo "<pre>";
print_r($colUser->find()->toArray());
echo "</pre>";
