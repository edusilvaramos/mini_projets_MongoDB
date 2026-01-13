<?php

namespace App\Model;

class Comment
{
    public ?string $id = null;
    public string $content;
    public string $postId;
    public string $userId;
    public string $createdAt;
    public ?string $updatedAt;

    public function __construct(
        string $content,
        string $postId,
        string $userId,
        ?string $createdAt = null,
        ?string $updatedAt = null
    ) {
        $this->content   = $content;
        $this->postId    = $postId;
        $this->userId    = $userId;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }
}
