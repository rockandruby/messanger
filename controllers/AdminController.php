<?php

use Core\Helper;

class AdminController extends BackController
{
    protected static $layout = 'admin';

    public function profile(){
        $admin = $this->currentUser();
        if(!empty($_POST)){
            $error = Helper::checkPasswordEquality($admin, $_POST['old_password'], $_POST['password'], $_POST['password_confirmation']);
            header('Location: /admin/profile');
            if($error) exit;
            Admin::update($admin->id, array_diff_key($this->formParams(), ['active' => 0]));
            Helper::notice('Admin updated!');
        }else{
            $this->view('admin/profile',['admin' => $admin]);
        }
    }

    public function users(){
        $users = User::all();
        $this->view('admin/users', ['users' => $users]);
    }

    public function user($params){
        $user = User::find($params[0]);
        if(!empty($_POST)){
            if(!empty($_POST['password'])){
                if ($_POST['password'] != $_POST['password_confirmation']){
                    Helper::alert('New password doesn\'t correspond to confirm!');
                    header('Location: /admin/user/'.$user->id);
                    exit;
                }
            }
            User::update($user->id, $this->formParams());
            Helper::notice('User updated!');
            header('Location: /admin/user/'.$user->id);
        }else{
            $this->view('admin/user', ['user' => $user]);
        }
    }

    public function newUser(){
        if (!empty($_POST)) {
            if ($_POST['password'] != $_POST['password_confirmation']){
                Helper::alert('Password doesn\'t correspond to confirm!');
                header('Location: /admin/newuser');
                exit;
            }
            $result = User::create($this->formParams());
            if(isset($result['error'])){
                Helper::alert($result['message']);
                header('Location: /admin/newuser');
            }else{
                Helper::notice('User created!');
                header('Location: /admin/users');
            }
        } else {
            $this->view('admin/newuser');
        }
    }

    public function deleteUser($params){
        User::delete($params[0]);
        Helper::notice('User deleted !');
        header('Location: /admin/users');
    }

    protected function formParams(){
        $params = parent::formParams();
        $params['active'] = isset($_POST['active']) ? 1 : 0;
        return $params;
    }

}
