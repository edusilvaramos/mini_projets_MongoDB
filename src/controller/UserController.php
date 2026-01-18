<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Connection\Connection;
use App\Model\User;

final class UserController extends BaseController
{
    // add constants by sonarqube recommendation
    private const TEMPLATE_SIGNUP = 'user/signup';
    private const REDIRECT_HOME = 'ctrl=home&action=index';

    private UserRepository $userRepository;

    public function __construct(Connection $connection)
    {
        $this->userRepository = new UserRepository($connection);
    }

    public function createUser(): void
    {
        $this->render(self::TEMPLATE_SIGNUP);
    }

    public function newUser(): void
    {

        $data = [
            'firstName' => trim($_POST['firstName'] ?? ''),
            'lastName'  => trim($_POST['lastName'] ?? ''),
            'username'  => trim($_POST['username'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'passwordHash'  => $_POST['passwordHash'] ?? '',
        ];

        // look if email or Username already exists
        if ($this->userRepository->findByEmail($data['email']) || $this->userRepository->findByUsername($data['username'])) {
            $this->render(self::TEMPLATE_SIGNUP, [
                'error' => 'Email/user name already exists.',
            ]);
            return;
        }
        $this->userRepository->createUser($data);
        $id = $_SESSION['user']['id'] ?? null;
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
        $login = $_POST['email'] ?? $_POST['username'] ?? '';

        $password = $_POST['passwordHash'] ?? '';

        // email ou username
        $user = $this->userRepository->findByEmail($login);
        if (!$user) {
            $user = $this->userRepository->findByUsername($login);
        }
        if (!$user || !password_verify($password, $user->passwordHash)) {
            $this->render('user/login');
            return;
        }

        $user->isConnected = true;
        $user->conectedAt = date('d/m/Y H:i');
        $this->userRepository->updateConnection($user->id, true);


        $_SESSION['user'] = [
            'id'        => $user->id,
            'firstName' => $user->firstName,
            'lastName'  => $user->lastName,
            'email'     => $user->email,
            'username'  => $user->username,
            'role'      => $user->role,
            'isConnected' => $user->isConnected,
            'conectedAt' => $user->conectedAt

        ];

        // go to home
        $this->redirect(self::REDIRECT_HOME);
    }

    public function logout(): void
    {
        $id = $_SESSION['user']['id'] ?? null;
        if (!$id) {
            $this->redirect(self::REDIRECT_HOME);
            return;
        }
        $user = $this->userRepository->findByID($id);
        $this->userRepository->updateConnection($user->id, false);

        unset($_SESSION['user']);
        session_regenerate_id(true);

        $this->redirect(self::REDIRECT_HOME);
    }

    public function deleteSelf(): void
    {
        $id = $_SESSION['user']['id'] ?? null;
        if ($id) {
            $this->userRepository->delete($id);
        }
        unset($_SESSION['user']);
        session_regenerate_id(true);
        $this->redirect(self::REDIRECT_HOME);
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
            $id = $_SESSION['user']['id'] ?? null;
            if (!$id) {
                $this->redirect('ctrl=user&action=login');
                return;
            }
            $user = $this->userRepository->findByID($id);
            $this->render('user/profil', [
                'user' => $user
            ]);
        }
    }


    public function edit(): void
    {
        $this->securityUser();
        $id = $_SESSION['user']['id'] ?? null;
        if (!$id) {
            $this->redirect('ctrl=user&action=login');
            return;
        }
        $user = $this->userRepository->findByID($id);
        $this->render(self::TEMPLATE_SIGNUP, [
            'user' => $user
        ]);
    }

    public function update(): void
    {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            $this->redirect('ctrl=user&action=profil');
            return;
        }

        $data = [
            'firstName' => trim($_POST['firstName'] ?? ''),
            'lastName'  => trim($_POST['lastName'] ?? ''),
            'username'  => trim($_POST['username'] ?? ''),
            'email'     => trim($_POST['email'] ?? ''),
            'passwordHash'  => $_POST['passwordHash'] ?? '',
        ];

        $this->userRepository->update($id, $data);
        $currentUserId = $_SESSION['user']['id'] ?? null;
        if (!$currentUserId) {
            $this->redirect('ctrl=user&action=login');
            return;
        }
        $currentUser = $this->userRepository->findByID($currentUserId);
        if ($currentUser->role == 'ROLE_ADMIN') {
            $this->redirect('ctrl=admin&action=userList');
        } else {
            $this->redirect('ctrl=user&action=profil');
        }
    }
}