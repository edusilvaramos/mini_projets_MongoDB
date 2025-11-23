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
    public function index(): void
    {
        $users = $this->userRepository->findAllUsers();
        $this->render('user/userList', ['users' => $users]);
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
        $this->redirect('ctrl=user&action=login');
    }

    public function login(): void
    {
        $this->render('user/login');
    }

    public function loginForm(): void
    {

        $login = $_POST['email']    ?? '';
        $password = $_POST['passwordHash'] ?? '';

        // email ou userName
        $user = $this->userRepository->findByEmail($login);
        if (!$user) {
            $user = $this->userRepository->findByuserName($login);
        }
        if (
            !$user
            || !password_verify($password, $user->passwordHash)
        ) {
            $this->render('user/login', [
                'error' => 'Email/username ou senha inválidos.',
                'old'   => ['email' => $login],
            ]);
            return;
        }

        $_SESSION['user'] = [
            'id'        => $user->id,
            'firstName' => $user->firstName,
            'lastName'  => $user->lastName,
            'email'     => $user->email,
            'userName'  => $user->userName,
        ];

        // go to home
        $this->redirect('ctrl=home&action=index');
    }

    public function logout(): void
    {
        $this->securityUser();
        unset($_SESSION['user']);
        session_regenerate_id(true);

        $this->redirect('ctrl=home&action=index');
    }

    public function delete(): void
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
        $this->render('user/profil');
    }

    public function edit(): void
    {
        $this->securityUser();
        $this->render('user/signup');
    }

    public function update(): void
    {
        $id = $_SESSION['user']['id'];

        $data = [
            'firstName' => trim($_POST['firstName'] ?? ''),
            'lastName'  => trim($_POST['lastName'] ?? ''),
            'userName'  => trim($_POST['userName'] ?? ''),
            'email'     => trim($_POST['email'] ?? ''),
            'passwordHash'  => $_POST['passwordHash'] ?? '',
        ];

        $this->userRepository->update($id, $data);
        $this->redirect('ctrl=user&action=index');
    }
}
