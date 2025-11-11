<?php

namespace App\Connection;

// use MongoDB\Driver\Manager;
// use MongoDB\Driver\Command;
use MongoDB\Database;
use MongoDB\Client;
use Dotenv\Dotenv;
use MongoDB\Collection;

if (!extension_loaded('mongodb')) {
    echo "ok for mongodb extension";
    throw new \RuntimeException('the mongodb extension is required');
} else {
    // echo "ok for mongodb extension";
}

final class Connection
{
    private Database $db;

    public function __construct()
    {
        // var env
        Dotenv::createImmutable(dirname(__DIR__, 2))->safeLoad();

        $uri  = $_ENV['MONGODB_URI'];
        $name = $_ENV['MONGODB_DB'];

        if (!$uri || !$name) {
            throw new \RuntimeException('the database connection is not configured');
        }

        $this->db = (new Client($uri))->selectDatabase($name);
    }

     public function selectCollection(string $name): Collection
    {
        return $this->db->selectCollection($name);
    }
}
