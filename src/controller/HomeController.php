<?php

namespace App\Controller;

final class HomeController extends BaseController
{
    public function index(): void
    {
        $posts = [];

        $this->render('home', [
            'title' => 'Home',
            'posts' => $posts,
        ]);
    }
}
