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
}
