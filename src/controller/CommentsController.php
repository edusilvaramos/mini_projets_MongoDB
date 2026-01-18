<?php

namespace App\Controller;

use App\Repository\CommentsRepository;
use App\Repository\PostRepository;
use App\Connection\Connection;

class CommentsController extends BaseController
{
    private CommentsRepository $commentRepository;
    private PostRepository $postRepository;

    private static function isValidObjectId(string $value): bool
    {
        return (bool) preg_match('/^[a-f0-9]{24}$/i', $value);
    }

    public function __construct(Connection $connection)
    {
        parent::__construct($connection);
        $this->commentRepository = new CommentsRepository($connection);
        $this->postRepository = new PostRepository($connection);
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
        $postId = trim((string) ($_POST['postId'] ?? ''));
        $content = trim((string) ($_POST['content'] ?? ''));
        $userId = (string) ($_SESSION['user']['id'] ?? '');
        $parentId = isset($_POST['parentId']) ? trim((string) $_POST['parentId']) : null;

        if (!self::isValidObjectId($postId)) {
            $this->redirect('ctrl=home&action=index');
        }

        if (!self::isValidObjectId($userId)) {
            $this->redirect('ctrl=user&action=login');
        }

        if ($parentId !== null && $parentId !== '' && !self::isValidObjectId($parentId)) {
            $parentId = null;
        }

        if ($content !== '') {
            $this->commentRepository->create([
                'postId' => $postId,
                'content' => $content,
                'userId' => $userId,
                'parentId' => $parentId,
            ]);

            $this->postRepository->increaseCommentsCounter($postId);
        }

        $this->redirect("ctrl=post&action=show&id=$postId");

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
