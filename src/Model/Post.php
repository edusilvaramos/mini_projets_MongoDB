<?php

namespace App\Model;

class Post
{
    public ?string $id = null;
    public string $title;
    public string $content;
    public string $category;
    public array $tags;
    public string $status;
    public string $authorId;
    public ?string $createdAt;
    public ?string $updatedAt;
    public int $likes;
    public int $views;
    public int $commentsCounter;

    public function __construct(
        string $title,
        string $content,
        string $category,
        string $authorId,
        array $tags = [],
        int $likes,
        int $views,
        int $commentsCounter,
        string $isPublished = true,
        ?string $createdAt = null,
        ?string $updatedAt = null
    ) {
        $this->title = $title;
        $this->content = $content;
        $this->category = $category;
        $this->authorId = $authorId;
        $this->tags = $tags;
        $this->status = $status;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->likes = $likes;
        $this->views = $views;
        $this->commentsCounter = $commentsCounter;
    }
}
