<?php

namespace App\Controller;
use App\Repository\PostRepository;
use App\Connection\Connection;

class HomeController extends BaseController
{
    private PostRepository $postRepository;

    public function __construct(Connection $connection)
    {
        $this->postRepository = new PostRepository($connection);
    }
    public function index(): void
    {
        $this->redirect('ctrl=post&action=listPosts&sort=recent&order=descending&category=all');
    }
}
