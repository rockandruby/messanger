<?php

class FrontController extends ApplicationController
{
    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            \Core\Helper::alert('Need to sign in!');
            header('Location: /auth/login');
            exit;
        }
        parent::__construct();
    }
}
