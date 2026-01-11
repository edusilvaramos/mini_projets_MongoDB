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

    public function add()
    {
        $connection = new Connection();
        $secyrity = new UserController($connection);
        $secyrity->securityUser();

        // Obter dados do POST e SESSION
        $comment = $_POST['comment'] ?? '';
        $postId = $_POST['postId'] ?? '';
        $userId = $_SESSION['user']['id'] ?? '';

        $this->commentRepository->create([
            'comment' => $comment,
            'userId' => $userId,
            // sperando a impelentacao do post
            'postId' => $postId
        ]);
        // ou pra a pagina do post depois de criada...
        $this->redirect('ctrl=post&action=index');
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
