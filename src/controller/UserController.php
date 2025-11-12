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
            'email'     => trim($_POST['email'] ?? ''),
            'password'  => $_POST['password'] ?? '',
        ];
        $this->userRepository->create($data);
        $this->redirect('ctrl=user&action=index');
    }

    public function edit(): void
    {
        $id = $_GET['id'] ?? '';
        $user = $this->userRepository->find($id);
        if (!$user) {
            http_response_code(404);
            echo 'Usuário não encontrado';
            return;
        }
        $this->render('user/edit', ['user' => $user]);
    }

    public function update(): void
    {
        $id = $_POST['id'];

        $data = [
            'firstname' => trim($_POST['firstname'] ?? ''),
            'lastName'  => trim($_POST['lastName'] ?? ''),
            'email'     => trim($_POST['email'] ?? ''),
            'password'  => $_POST['password'] ?? '',
        ];
        $this->userRepository->update($id, $data);
        $this->redirect('ctrl=user&action=index');
    }

    public function delete(): void
    {
        $id = $_GET['id'] ?? ($_POST['id'] ?? '');
        $this->userRepository->delete($id);
        $this->redirect('ctrl=user&action=index');
    }

    public function loginForm(): void
    {
        $this->render('user/login');
    }

    public function login(): void
    {
        $email = $_POST['email']    ?? '';
        $password = $_POST['password'] ?? '';

        var_dump($_POST);



        $user = $this->userRepository->findByEmail($email);

        // se não achou ou senha errada
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
            'firstname' => $user['firstname'] ?? '',
            'email'     => $user['email'] ?? '',
        ];

        // manda pra home ou lista de posts
        $this->redirect('ctrl=home&action=index');
    }

    public function logout(): void
    {
        unset($_SESSION['user']);
        session_regenerate_id(true); // segurança

        $this->redirect('ctrl=home&action=index');
    }
}
