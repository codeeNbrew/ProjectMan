<?php

class AuthController {
    private $model;
    public function __construct($model) {
        $this->model = $model;
    }

    public function login() {
        if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
            header("Location: index.php?action=listProject");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            // Panggil mesin Model untuk cek ke database
            if ($this->model->login($username, $password)) {
                header("Location: index.php?action=listProject");
                exit;
            } else {
                $error = "Username atau Password salah!";
            }
        }

        require_once "views/auth/login.php";
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = [];
        session_unset();
        session_destroy();

        header("Location: index.php?action=login");
        exit;
    }
}