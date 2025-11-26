<?php
// src/Controller/AdminController.php
namespace App\Controller;

use App\Connection\Connection;
use App\Repository\AdminRepository;
use App\Repository\UserRepository;

class AdminController extends BaseController
{
    private AdminRepository $adminRepository;
    private UserRepository $userRepository;

    public function __construct()
    {
        $connection = new Connection();
        $this->adminRepository = new AdminRepository($connection);
        $this->userRepository  = new UserRepository($connection);
    }

    public function index(): void
    {
        $users = $this->userRepository->findAllUsers();
        $selectedUserId = $_GET['userId'] ?? null;

        $topics = [];
        $nbParticipants = 0;

        if ($selectedUserId) {
        }

        $this->render('admin/index', [
            'users'          => $users,
            'selectedUserId' => $selectedUserId,
            'topics'         => $topics,
            'nbParticipants' => $nbParticipants,
            // add plus de infos 
        ]);
    }
    public function userList(): void
    {
        $users = $this->userRepository->findAllUsers();
        $this->render('admin/userList', ['users' => $users]);
    }

    public function adminDelete(): void
    {
        $currentUser = $_SESSION['user'];

        $idToDelete = $_POST['id'];

        if ($idToDelete === $currentUser->id) {
            $this->redirect('ctrl=admin&action=userList');
        }
        // admin cannot delete itself
        if ($idToDelete === $currentUser->id) {
            $this->redirect('ctrl=admin&action=userList');
        }

        $this->userRepository->delete($idToDelete);
        $this->redirect('ctrl=admin&action=userList');
    }

    // edit user
    public function adminEdit(): void
    {
        $id = $_GET['id'];
        $user = $this->userRepository->findByID($id);
        $this->render('user/signup', [
            'user' => $user
        ]);
    }


    public function adminUpdate(): void
    {
        $id = $_POST['id'];

        $data = [
            'firstName' => trim($_POST['firstName'] ?? ''),
            'lastName'  => trim($_POST['lastName'] ?? ''),
            'userName'  => trim($_POST['userName'] ?? ''),
            'email'     => trim($_POST['email'] ?? ''),
            'passwordHash'  => $_POST['passwordHash'] ?? '',
        ];

        $this->userRepository->update($id, $data);
        $this->redirect('ctrl=admin&action=userList');
    }
}
