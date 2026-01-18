<?php

namespace App\Controller;

use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Connection\Connection;

final class PostController extends BaseController
{
    /*
        TÂCHES
        + update a post 
        + delete a post
        + list posts
        + sorting buttons
        
        - go to post page
        - filter by tag
        - increase/decrease likes (connexion avec user)
        - increase views
        - increase commentsCounter
        - Implementer si cest un brouillon ou publie
     */
    private PostRepository $postRepository;

    public function __construct($connection)
    {
        $this->postRepository = new PostRepository($connection);
    }

    //Show one post (GET /posts/{id})
    public function show(): void
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            $this->redirect('ctrl=home&action=index');
            return;
        }

        // Increment views
        $this->postRepository->increaseViews($id);

        // Post + author
        $post = $this->postRepository->findWithAuthor($id);

        if (!$post) {
            $this->redirect('ctrl=home&action=index');
        }

        $this->render('post/readPost', [
            'post' => $post
        ]);
    }

    //Page de creation de post
    public function create(): void
    {
        $this->ensureLoggedIn();
        $this->render('post/createPostPage');
    }

    //Aditionner à la base de donnees
    public function add(): void
    {
        $this->ensureLoggedIn();

        $data = [
            'title' => trim($_POST['title'] ?? ''),
            'content'  => trim($_POST['content'] ?? ''),
            'category' => trim($_POST['category'] ?? ''),
            'authorId'  => $_SESSION['user']['id'],
            'tags' => $_POST['tags'] ?? [],
        ];
        if ($data['title'] === '' || $data['content'] === '') {
            $this->redirect('/posts/create');
        }

        $id = $this->postRepository->create($data);
        $this->redirect('/posts/' . $id);
    }

    public function like($id) {
        $this->ensureLoggedIn();

        if (!$id) {
            $this->redirect('ctrl=home&action=index');
            return;
        }
        $this->postRepository->incrementLike($id);

        $this->redirect('/posts/' . $id);
    }

    public function unlike(string $id): void
    {
        $this->ensureLoggedIn();

        if (!$id) {
            $this->redirect('ctrl=home&action=index');
            return;
        }
        
        $this->postRepository->decreaseLike($id);

        $this->redirect('/posts/' . $id);
    }

    public function edit($id): void
    {
        $this->ensureLoggedIn();

        $post = $this->postRepository->find($id);

        if (!$post || (string)$post['authorId'] !== $_SESSION['user_id']) {
            $this->redirect('ctrl=user&action=index');
        }
        $data = [
            'title' => trim($_POST['title'] ?? ''),
            'content' => trim($_POST['content'] ?? ''),
        ];
        $this->postRepository->update($id, $data);
        $this->redirect('ctrl=home&action=index');

        $this->render('post/edit', [
            'post' => $post
        ]);
    }

    public function update(string $id): void
    {
        $this->ensureLoggedIn();

        $post = $this->postRepository->find($id);

        if (!$post || (string)$post['authorId'] !== $_SESSION['user_id']) {
            $this->redirect('ctrl=user&action=index');
        }

        $data = [
            'title'   => trim($_POST['title']),
            'content' => trim($_POST['content']),
            // tags later
        ];

        $this->postRepository->update($id, $data);

        $this->redirect('/posts/' . $id);
    }

    //_______________________________________________________

    public function listPosts(): void
    {
        $sort = $_GET['sort'] ?? 'recent';
        $order = $_GET['order'] ?? 'descending';
        $direction = ($order === 'ascending') ? 1 : -1;

        switch ($sort) {
            case 'recent':
                $posts = $this->postRepository->sortBy('createdAt', $direction);
                break;
            case 'liked':
                $posts = $this->postRepository->sortBy('likes', $direction);
                break;
            case 'views':
                $posts = $this->postRepository->sortBy('views', $direction);
                break;
            case 'comments':
                $posts = $this->postRepository->sortBy('commentsCounter', $direction);
                break;
            default:
                $posts = $this->postRepository->all();
        }

        $this->render('components/home', [
            'posts' => $posts,
            'sort'  => $sort,
            'order' => $order
        ]);
    }


    
    
    

    public function delete($id): void
    {
        $this->ensureLoggedIn();
        $post = $this->postRepository->find($id);
        $this->postRepository->delete($id);
        $this->redirect('ctrl=user&action=index');

        $this->redirect('posts');
    }

    

    

    private function ensureLoggedIn(): void
    {
        if (empty($_SESSION['user'])) {
            $this->redirect('ctrl=user&action=login');
        }
    }
}
