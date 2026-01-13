<?php

namespace App\Controller;

use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Dba\Connection;

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
        if (empty($_SESSION['user'])) {
            $this->redirect('ctrl=user&action=login');
        }
    }

    public function listPosts(): void
    {
        $sort = $_GET['sort'] ?? 'recent';
        switch ($sort) {
            case 'recent':
                $posts = $this->postRepository->sortRecent();
            case 'liked':
                $posts = $this->postRepository->sortMostLiked();
                break;
            case 'views':
                $posts = $this->postRepository->sortMostViewed();
                break;
            case 'comments':
                $posts = $this->postRepository->sortMostCommented();
                break;
            default:
                $posts = $this->postRepository->all();
        }
        if ($_GET['order'] === "decroissant"){
            $posts = array_reverse($posts);
        }
        $this->render('home', ['post' => $posts]);
        include __DIR__ . '/../../views/templates/components/home.php';
    }

    public function createPostPage(): void
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('ctrl=home&action=index');
        }
        $this->render('post/createPostPage');
    }

    public function readPost($postID): void
    {
        $id = $postID;
        if (!$id) {
            $this->redirect('ctrl=user&action=login');
            return;
        }

        $post = $this->postRepository->find($id);
        
        if (!$post) {
            $this->redirect('ctrl=user&action=signup');
            return;
        }

        $this->render('post/readPost', [
            'post' => $post,
        ]);
    }
    
    public function add(): void
    {
        $data = [
            'title' => trim($_POST['title'] ?? ''),
            'content'  => trim($_POST['content'] ?? ''),
            'category' => trim($_POST['category'] ?? ''),
            'authorId'  => $_SESSION['user']['id'],
        ];
        $postID = $this->postRepository->create($data);
        $this->readPost($postID);
        exit;
    }

    public function delete(): void
    {
        $id = $_GET['id'] ?? ($_POST['id'] ?? '');
        $this->postRepository->delete($id);
        $this->redirect('ctrl=user&action=index');
    }

    public function edit(): void
    {
        $id = $_POST['id'] ?? '';

        $data = [
            'title' => trim($_POST['title'] ?? ''),
            'content' => trim($_POST['content'] ?? ''),
        ];
        $this->postRepository->update($id, $data);
        $this->redirect('ctrl=user&action=index');
    }
}
