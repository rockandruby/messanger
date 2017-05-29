<?php
namespace Controllers\Mixins;
use Core\Helper as Helper;

trait Auth {

    public function login()
    {
        if (isset($_SESSION[$this->role])) {
            header('Location: /'.$this->role.'/profile');
            exit;
        }
        $path = $this->role == 'user' ? '/auth/login' : '/adminauth/login';
        if (!empty($_POST)) {
            $model = ucfirst($this->role);
            $params = $this->formParams();
            $user = $model::signIn($params['email'], $params['password']);
            if($user){
                Helper::notice('Hello again!');
                $this->openSession($user['id']);
                header('Location: /'.$this->role.'/profile');
            }else{
                Helper::alert('Invalid credentials');
                header('Location: '.$path);
            }
        } else {
            $this->view($path);
        }
    }

    public function signOut(){
        $role = strpos($_SERVER['REQUEST_URI'], 'admin') ? 'admin' : 'user';
        if(isset($_SESSION[$role])){
            Helper::notice('See you!');
            $_SESSION[$role] = null;
            header('Location: /');
        }
    }

    public function register()
    {
        if (isset($_SESSION[$this->role])) {
            header('Location: /'.$this->role.'/profile');
            exit;
        }
        $path = $this->role == 'user' ? '/auth/register' : '/adminauth/register';
        if (!empty($_POST)) {
            $model = ucfirst($this->role);
            if ($_POST['password'] != $_POST['password_confirmation']){
                Helper::alert('Password doesn\'t correspond to confirm!');
                header('Location: '.$path);
                exit;
            }
            $user = $model::create($this->formParams());
            if(isset($user['error'])){
                Helper::alert($user['message']);
                header('Location: '.$path);
            }else{
                Helper::notice('Hello again!');
                $this->openSession($user);
                header('Location: /'.$this->role.'/profile');
            }
        } else {
            $this->view($path);
        }
    }
}
