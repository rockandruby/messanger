<?php

use Core\Helper;

class ApplicationController
{

    protected static $layout = 'application';

    public function __construct()
    {
        $this->role = strpos($_SERVER['REQUEST_URI'], 'admin') ? 'admin' : 'user';
    }

    /**
     * @return mixed
     *
     * fetches authenticated user object
     */
    protected function currentUser(){
        $model = ucfirst($this->role);
        static $current_user;
        if(!isset($current_user)) $current_user = $model::find($_SESSION[$this->role]);
        return $current_user;
    }

    /**
     * loads controller view
     * @param $view
     * @param array $vars
     *
     */
    protected function view($view, array $vars = [])
    {
        $content = $this->getContent($view, $vars);
        include_once Helper::viewPath() . 'layouts/' . static::$layout . '.php';
    }

    /**
     * @param array $permitted_params key => value
     * @return array
     * returns safe params without spaces and special characters
     */
    protected function safeParams(array $permitted_params)
    {
        $safe_params = [];
        foreach ($permitted_params as $k => $v) {
            if (empty(trim($v))) continue;
            $safe_params[$k] = htmlentities($v);
        }
        return $safe_params;
    }

    /**
     * @param $user_id
     *
     * creates session for user
     */
    protected function openSession($user_id){
        $_SESSION['user'] = $user_id;
        if(isset($_SESSION['admin'])) $_SESSION['admin'] = null;
    }

    protected function isAuthed(){
        return $_SESSION['user'] ?? false;
    }

    protected function formParams(){
        return $this->safeParams([
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => Helper::formSecurePassword($_POST['password'])
        ]);
    }

    private function getContent($view, $vars)
    {
        ob_start();
        extract($vars);
        include_once Helper::viewPath() . $view . '.php';
        $content = ob_get_contents();
        ob_clean();
        return $content;
    }

}
