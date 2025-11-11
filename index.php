<?php

require __DIR__ . '/vendor/autoload.php';

use App\Connection\Connection;
use MongoDB\BSON\UTCDateTime;

$db  = new Connection();
$colUser = $db->selectCollection('user');

echo "<pre>";
print_r($colUser->find()->toArray());
echo "</pre>";