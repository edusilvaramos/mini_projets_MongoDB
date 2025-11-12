<?php

namespace App\Controller;


final class HomeController extends BaseController
{
    public function index(): void
    {
        // criar o crud dos posts
        // $posts = (new PostRepository())->all();
        $posts = [];
        $this->render('layout/home', ['posts' => $posts]);
    }
}