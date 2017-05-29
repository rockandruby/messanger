<?php

require_once 'mixins/AuthMixin.php';

class AdminauthController extends ApplicationController
{
    use \Controllers\Mixins\Auth;

    protected static $layout = 'admin';

    protected function openSession($admin_id){
        $_SESSION['admin'] = $admin_id;
        if(isset($_SESSION['user'])) $_SESSION['user'] = null;
    }

}