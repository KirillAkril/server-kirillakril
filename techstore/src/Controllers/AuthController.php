<?php

class AuthController
{
    public function login(): void
    {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $login = $_POST['login'];

            $password = $_POST['password'];

            if (
                $login === 'admin'
                &&
                $password === '12345'
            ) {

                $_SESSION['admin'] = true;

                header('Location: /?route=products');

                exit;

            } else {

                $error = 'Неверный логин или пароль';
            }
        }

        require __DIR__ .
            '/../../templates/auth/login.php';
    }

    public function logout(): void
    {
        session_destroy();

        header('Location: /');

        exit;
    }
}