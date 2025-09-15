<?php

namespace Controller;

use Model\Dao\UserDao;

class UserController {

    public function login() {
        require 'View/user/login.php';
    }

    public function register() {
        require 'View/user/register.php';
    }

    public function doLogin() {
        $email = htmlentities($_POST['email']);
        $password = htmlentities($_POST['password']);
        $error = "";

        $user = UserDao::getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_id'] = $user['id'];

            if ($user["is_admin"] == 1) {
                $_SESSION["isAdmin"] = true;
            } else {
                $_SESSION["isAdmin"] = false;
            }

            header('Location: ?target=calendar&action=index');
            die();
        } else {
            $error = "Грешен имейл или парола!";
            require 'View/user/login.php';
            die();
        }
    }

    public function doRegister() {
        $email = htmlentities($_POST['email']);
        $password = htmlentities($_POST['password']);
        $first_name = htmlentities($_POST['first_name']);
        $last_name = htmlentities($_POST['last_name']);
        $error = "";

        $existingUser = UserDao::getUserByEmail($email);

        if ($existingUser) {
            $error = "Вече съществува потребител с този имейл!";
            require 'View/user/register.php';
            die();
        }


        $hashed = password_hash($password, PASSWORD_BCRYPT);
        UserDao::insertUser($email, $hashed, $first_name, $last_name);
        header("Location: index.php?target=user&action=login");
        die();
    }
}
