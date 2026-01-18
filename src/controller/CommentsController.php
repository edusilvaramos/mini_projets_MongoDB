<?php

namespace App\Controller;

use App\Repository\CommentsRepository;
use App\Controller\UserController;
use App\Connection\Connection;

class CommentsController extends BaseController
{
    private CommentsRepository $commentRepository;

    public function __construct()
    {
        $this->commentRepository = new CommentsRepository();
        if (empty($_SESSION['user'])) {
            $this->redirect('ctrl=user&action=login');
        }
    }

    public function formComment(): void
    {
        $this->render('comment/formComment');
    }

    public function create()
    {
        $connection = new Connection();
        $security = new UserController($connection);
        $security->securityUser();

        $postId = $_POST['postId'] ?? '';

        $this->commentRepository->create([
            'postId' => $postId,
            'content' => $_POST['content'] ?? '',
            'userId' => $_SESSION['user']['id'] ?? '',
            'parentId' => $_POST['parentId'] ?? null
        ]);

        $this->redirect("index.php?ctrl=post&action=show&id=$postId");

    }

    public function edit(): void
    {
        $id = $_POST['id'] ?? '';

        $data = [
            'comment' => trim($_POST['comment'] ?? ''),
        ];
        $this->commentRepository->update($id, $data);
        $this->redirect('ctrl=user&action=index');
    }

    // sow time, ex: 5 days ago, 7 months ago

    // editar
    
    // delete comment onli author or admin
    public function delete(): void
    {
        $id = $_GET['id'] ?? ($_POST['id'] ?? '');
        $this->commentRepository->delete($id);
        $this->redirect('ctrl=user&action=index');
    }
}