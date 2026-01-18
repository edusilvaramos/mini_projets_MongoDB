<?php

namespace App\Model;

class Comment
{
    public ?string $id = null;
    public string $content;
    public string $postId;
    public string $userId;
    public string $createdAt;
    public int $likes;

    public function __construct(
        string $content,
        string $postId,
        string $userId,
        int $likes,
        ?string $createdAt = null,
        
    ) {
        $this->content   = $content;
        $this->postId    = $postId;
        $this->userId    = $userId;
        $this->likes = $likes;
        $this->createdAt = $createdAt;
    }
}
