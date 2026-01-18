<?php

namespace App\Model;
use MongoDB\BSON\UTCDateTime;

class Post
{
    public ?string $id = null;
    public string $title;
    public string $content;
    public string $authorId;
    public array $category;
    public string $status;
    public ?string $createdAt;
    public int $likes;
    public int $views;
    public int $commentsCounter;

    public function __construct(
        string $title,
        string $content,
        string $authorId,
        array $category = [],
        string $status,
        ?string $createdAt = null,
        int $likes,
        int $views,
        int $commentsCounter,
        
    ) {
        $this->title = $title;
        $this->content = $content;  
        $this->authorId = $authorId;
        $this->category = $category;
        $this->status = $status;
        $this->createdAt = $createdAt;
        $this->likes = $likes;
        $this->views = $views;
        $this->commentsCounter = $commentsCounter;
    }
}
