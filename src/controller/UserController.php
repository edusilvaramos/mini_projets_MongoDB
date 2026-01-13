<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Connection\Connection;
use App\Model\User;

final class UserController extends BaseController
{
    private UserRepository $userRepository;

    public function __construct(Connection $connection)
    {
        $this->userRepository = new UserRepository($connection);
    }

    public function createUser(): void
    {
        $this->render('user/signup');
    }

    public function newUser(): void
    {

        $data = [
            'firstName' => trim($_POST['firstName'] ?? ''),
            'lastName'  => trim($_POST['lastName'] ?? ''),
            'userName'  => trim($_POST['userName'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'passwordHash'  => $_POST['passwordHash'] ?? '',
        ];

        // look if email or userName already exists
        if ($this->userRepository->findByEmail($data['email']) || $this->userRepository->findByuserName($data['userName'])) {
            $this->render('user/signup', [
                'error' => 'Email/user name already exists.',
            ]);
            return;
        }

        $this->userRepository->createUser($data);
        $id = $_SESSION['user']['id'];
        if ($id) {
            $currentUser = $this->userRepository->findByID($id);
            if ($currentUser->role == 'ROLE_ADMIN') {
                $this->redirect('ctrl=admin&action=userList');
            }
        } else {
            $this->redirect('ctrl=user&action=profil');
        }
    }

    public function login(): void
    {
        $this->render('user/login');
    }

    public function loginForm(): void
    {
        
        if (!empty($_SESSION['user'])) {
            echo "Welcome, " . htmlspecialchars($_SESSION['user']['firstName']);
        } else {
            echo "Not logged in";
        }

        $login = $_POST['email'] ?? ($_POST['userName'] ?? '');
        $password = $_POST['passwordHash'] ?? '';

        if (empty($login) || empty($password)) {
            $this->render('user/login', ['error' => 'Please enter email/username and password.']);
            return;
        }

        $user = $this->userRepository->findByEmail(mb_strtolower($login));
        if (!$user) {
            $user = $this->userRepository->findByUserName($login);
        }

        $hash = $user->passwordHash ?? null;
        
        if (password_verify($password, $hash)) {
            echo "Password matches!";
        } else {
            echo "Password does NOT match!";
        }

        if (!password_verify($password, $hash)) {
            
            $this->render('user/login', ['error' => 'Invalid login credentials.']);
            return;
        }

        $user->isConnected = true;
        $user->conectedAt = date('d/m/Y H:i');
        $this->userRepository->updateConnection($user->id, true);

        $_SESSION['user'] = [
            'id'          => $user->id,
            'firstName'   => $user->firstName,
            'lastName'    => $user->lastName,
            'email'       => $user->email,
            'userName'    => $user->userName,
            'role'        => $user->role,
            'isConnected' => $user->isConnected,
            'conectedAt'  => $user->conectedAt
        ];
        $this->redirect("index.php?ctrl=home&action=index");
        exit;
    }



    public function logout(): void
    {
        $id = $_SESSION['user']['id'];
        $user = $this->userRepository->findByID($id);
        $this->userRepository->updateConnection($user->id, false);

        unset($_SESSION['user']);
        session_regenerate_id(true);

        $this->redirect('ctrl=home&action=index');
    }

    public function deleteSelf(): void
    {
        $this->userRepository->delete($_SESSION['user']['id']);
        unset($_SESSION['user']);
        session_regenerate_id(true);
        $this->redirect('ctrl=home&action=index');
    }

    // to evite user without login 
    public function securityUser(): void
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('ctrl=user&action=login');
        }
    }

    public function profil(): void
    {
        $this->securityUser();
        $idLook = $idLook = isset($_GET['id']) ? $_GET['id'] : null;
        if ($idLook) {
            $user = $this->userRepository->findByID($idLook);
            $this->render('user/profil', [
                'user' => $user
            ]);
        } else {
            $id = $_SESSION['user']['id'];
            $user = $this->userRepository->findByID($id);
            $this->render('user/profil', [
                'user' => $user
            ]);
        }
    }


    public function edit(): void
    {
        $this->securityUser();
        $id = $_SESSION['user']['id'];
        $user = $this->userRepository->findByID($id);
        $this->render('user/signup', [
            'user' => $user
        ]);
    }

    public function update(): void
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
        $id = $_SESSION['user']['id'];
        $currentUser = $this->userRepository->findByID($id);
        if ($currentUser->role == 'ROLE_ADMIN') {
            $this->redirect('ctrl=admin&action=userList');
        } else {
            $this->redirect('ctrl=user&action=profil');
        }
    }
}
