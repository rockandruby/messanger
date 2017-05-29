<?php

class BackController extends ApplicationController
{
    public function __construct()
    {
        if (!isset($_SESSION['admin'])) {
            \Core\Helper::alert('Need to sign in!');
            header('Location: /adminauth/login');
            exit;
        }
        parent::__construct();
    }

}