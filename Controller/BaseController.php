<?php

namespace Controller;

class BaseController {

    public function index() {
        require 'View/user/login.php';
    }

    public function logout() {
        session_destroy();
        header("Location: index.php");
        die();
    }
}
