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
        $tag = $_GET['tag'] ?? null;

        if ($tag) {
            $posts = $this->postRepository->findByTag($tag);
        } else {
            $posts = $this->postRepository->sortBy('createdAt', -1); // default: recent posts
        }

        $this->render('components/home', [
            'posts' => $posts,
        ]);
    }
}
