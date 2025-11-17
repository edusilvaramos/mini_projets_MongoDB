<?php

namespace App\Controller;

use App\Repository\UserRepository;

final class UserController extends BaseController
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function index(): void
    {
        $users = $this->userRepository->all();
        $this->render('user/userList', ['users' => $users]);
    }

    public function createUser(): void
    {
        $this->render('user/newUser');
    }

    public function newUser(): void
    {
        $data = [
            'firstname' => trim($_POST['firstname'] ?? ''),
            'lastName'  => trim($_POST['lastName'] ?? ''),
            'userName'  => trim($_POST['username'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'password'  => $_POST['password'] ?? '',
        ];

        // create message if email or username already exists or return to form
        if ($this->userRepository->findByEmail($data['email']) || $this->userRepository->findByUsername($data['userName'])) {
            $this->render('user/newUser', [
                'error' => 'Email already exists.',
            ]);
            return;
        }

        $this->userRepository->create($data);
        $this->redirect('ctrl=user&action=login');
    }

    public function loginForm(): void
    {
        $this->render('user/login');
    }

    public function login(): void
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // email or user name 
        $user = $this->userRepository->findByEmail($email);

        if (!$user) {
            $user = $this->userRepository->findByUsername($email);
        }

        // if no user or password is wrong
        if (!$user || !password_verify($password, $user['passwordHash'])) {
            $this->render('user/login', [
                'error' => 'Email or password is not valid.',
                'old'   => ['email' => $email],
            ]);
            return;
        }

        // guarda infos básicas na sessão
        $_SESSION['user'] = [
            'id'        => (string) $user['_id'],
            'firstname' => $user['firstname'],
            'email'     => $user['email'],
            'username'  => $user['userName'],
        ];

        // manda pra home ou lista de posts ou new post
        $this->redirect('ctrl=home&action=index');
    }

    public function logout(): void
    {
        $this->securityUser();
        unset($_SESSION['user']);
        session_regenerate_id(true); // segurança

        $this->redirect('ctrl=home&action=index');
    }


    public function edit(): void
    {
        $this->securityUser();
        $id = $_GET['id'] ?? '';
        $user = $this->userRepository->find($id);
        if (!$user) {
            http_response_code(404);
            echo 'user not found';
            return;
        }
        $this->render('user/edit', ['user' => $user]);
    }

    public function update(): void
    {
        $this->securityUser();
        $id = $_POST['id'] ?? '';

        $data = [
            'firstname' => trim($_POST['firstname'] ?? ''),
            'lastName'  => trim($_POST['lastName'] ?? ''),
            'userName'  => trim($_POST['username'] ?? ''),
            'email'     => trim($_POST['email'] ?? ''),
            'password'  => $_POST['password'] ?? '',
        ];

        $this->userRepository->update($id, $data);
        $this->redirect('ctrl=user&action=index');
    }

    public function delete(): void
    {
        $this->securityUser();
        $id = $_GET['id'] ?? ($_POST['id'] ?? '');
        $this->userRepository->delete($id);
        $this->redirect('ctrl=user&action=index');
    }

    // to evite user without login 
    public function securityUser(): void
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('ctrl=home&action=login');
        }
    }
}
