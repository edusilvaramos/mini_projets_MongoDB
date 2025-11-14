<?php 

namespace App\Controller;

use App\Repository\CommentsRepository;

class CommentsController extends BaseController
{

    
    public function formComment(): void
    {
        $this->render('comment/formComment');
    }

    public function add()
    {
        if(empty($_SESSION['user'])) {
            $this->redirect('ctrl=user&action=login');
        }

        $comentRepo = new CommentsRepository();
        $comentRepo->create([
            'comment' => $_POST['comment'],
            'userId' => $_SESSION['user']['id'],
            // sperando a impelentacao do post
            // 'postId' => $_POST['postId']
        ]);
        // ou pra a pagina do post depois de criada...
        $this->redirect('ctrl=post&action=index');

    }
}