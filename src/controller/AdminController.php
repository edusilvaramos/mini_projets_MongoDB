<?php
namespace App\Controller;

use App\Connection\Connection;
use App\Repository\AdminRepository;
use App\Repository\UserRepository;
use App\Repository\FeaturesRepository;

class AdminController extends BaseController
{
    private AdminRepository $adminRepository;
    private UserRepository $userRepository;
    private FeaturesRepository $featuresRepository;

    public function __construct()
    {
        $connection = new Connection();
        $this->adminRepository = new AdminRepository($connection);
        $this->userRepository  = new UserRepository($connection);
        $this->featuresRepository = new FeaturesRepository($connection);
    }

     public function userList(): void
    {
        $users = $this->userRepository->findAllUsers();
        $globalStats = $this->adminRepository->getGlobalStats();
        
        $this->render('admin/userList', [
            'users' => $users,
            'globalStats' => $globalStats
        ]);
    }
    
    public function userProfile(): void
    {
        // só admin pode entrar aqui
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'ROLE_ADMIN') {
            $this->redirect('ctrl=home&action=index');
        }

        $id = $_GET['id'] ?? null;

        if (!$id) {
            $this->redirect('ctrl=admin&action=userList');
        }

        $user = $this->userRepository->findById($id);
        if (!$user) {
            $this->redirect('ctrl=admin&action=userList');
        }

        $globalStats = $this->adminRepository->userGlobalStats($id);
        $postsStats = $this->adminRepository->userPostsStats($id);
    
        
        $this->render('admin/userProfile', [
            'user' => $user,
            'globalStats' => $globalStats,
            'postsStats' => $postsStats,
        ]);
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
            'username'  => trim($_POST['username'] ?? ''),
            'email'     => trim($_POST['email'] ?? ''),
            'passwordHash'  => $_POST['passwordHash'] ?? '',
        ];

        $this->userRepository->update($id, $data);
        $this->redirect('ctrl=admin&action=userList');
    }

    // features management for admin (prof)
    public function features(): void
    {        
        $features = $this->featuresRepository->findAll();

        $this->render('admin/features', ['features' => $features]);
    }

    public function featureCreate(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('ctrl=admin&action=features');
        }

        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'author' => trim($_POST['author'] ?? 'Eduardo'),
            'category' => $_POST['category'] ?? '',
            'status' => $_POST['status'] ?? 'Non développée',
        ];

        $this->featuresRepository->create($data);
        $this->redirect('ctrl=admin&action=features');
    }

    public function featureDelete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('ctrl=admin&action=features');
        }

        $id = (int)($_POST['id'] ?? 0);
        
        if ($id > 0) {
            $this->featuresRepository->delete($id);
        }

        $this->redirect('ctrl=admin&action=features');
    }
}
