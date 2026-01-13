<?php

namespace App\Model;

class Like
{
    public ?string $id = null;
    public string $userId;
    public string $postId;

    public function __construct(
        string $userId,
        string $postId,
    ) {
        $this->userId    = $userId;
        $this->postId    = $postId;
    }
}
