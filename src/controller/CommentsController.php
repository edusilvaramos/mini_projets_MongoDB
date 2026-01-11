<?php

namespace App\Controller;

use App\Repository\CommentsRepository;

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
        if (empty($_SESSION['user'])) {
            $this->redirect('ctrl=user&action=login');
        }

        $comentRepo = new CommentsRepository();
        $comentRepo->create([
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'userId' => $_SESSION['user']['id'],
            // sperando a impelentacao do post
            // 'postId' => $_POST['postId']
        ]);
        // ou pra a pagina do post depois de criada...
        $this->redirect('ctrl=post&action=index');
    }

    public function edit(): void
    {
        $id = $_POST['id'] ?? '';

        $data = [
            'title' => trim($_POST['title'] ?? ''),
            'content' => trim($_POST['content'] ?? ''),
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
