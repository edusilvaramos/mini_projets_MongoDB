<?php

namespace App\Controller;

use App\Repository\PostRepository;
use App\Repository\CommentsRepository;
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
    private CommentsRepository $commentsRepository;

    public function __construct($connection)
    {
        $this->postRepository = new PostRepository($connection);
        $this->commentsRepository = new CommentsRepository($connection);
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

        $recentPosts = $this->postRepository->sortBy('createdAt', -1);

        /*$comments = $this->commentsRepository->findByPost($id);
        $nestedComments = [];
        
        foreach ($comments as $comment) {
            $parent = $this->oidToString($comment['parentId'] ?? null);
            $nestedComments[$parent][] = $comment;
        }*/

        $this->render('post/readPost', [
            'post' => $post,
            'recentPosts' => $recentPosts
            //'comments' => $nestedComments
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

    public function like() 
    {
        $this->ensureLoggedIn();
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect('ctrl=home&action=index');
            return;
        }
        $this->postRepository->incrementLike($id);

        $this->redirect('ctrl=post&action=show&id='.$id);
    }

    public function unlike(): void
    {
        $id = $_GET['id'] ?? null;
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
        $tag = $_GET['tag'] ?? 'all';

        switch ($sort) {
            case 'recent':
                $posts = $this->postRepository->sortBy('createdAt', $direction, $tag);
                break;
            case 'liked':
                $posts = $this->postRepository->sortBy('likes', $direction, $tag);
                break;
            case 'views':
                $posts = $this->postRepository->sortBy('views', $direction, $tag);
                break;
            case 'comments':
                $posts = $this->postRepository->sortBy('commentsCounter', $direction, $tag);
                break;
            default:
                $posts = $this->postRepository->all();
        }

        $this->render('components/home', [
            'posts' => $posts,
            'sort'  => $sort,
            'order' => $order,
            'tag' => $tag,
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

    function oidToString($value): ?string {
        if ($value instanceof MongoDB\BSON\ObjectId) {
            return (string) $value;
        }
        if (is_array($value) && isset($value['$oid'])) {
            return $value['$oid'];
        }
        return null;
    }
}
