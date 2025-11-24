<?php

namespace App\Repository;

use App\Connection\Connection;
use MongoDB\BSON\ObjectId;
use MongoDB\Collection;

class AdminRepository
{
    private Collection $topics;
    private Collection $comments;
    private Collection $users;
}
