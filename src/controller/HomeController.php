<?php

namespace App\Controller;

final class HomeController extends BaseController
{
    public function index(): void
    {
        $posts = [];

        $this->render('components/home', [
            'title' => 'Home',
            'posts' => $posts,
        ]);
    }
}
