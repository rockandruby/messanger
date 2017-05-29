<?php
namespace Core;

class Helper
{
    public static function alert($text = ''){
        setcookie('error', $text, time() + 5, '/');
        if(isset($_COOKIE['error'])) echo "<div class='alert'>{$_COOKIE['error']}</div>";
    }

    public static function notice($text = ''){
        setcookie('success', $text, time() + 5, '/');
        if(isset($_COOKIE['success'])) echo "<div class='notice'>{$_COOKIE['success']}</div>";
    }

    public static function viewPath(){
        return getcwd() . '/public/views/';
    }

    public static function isActive($var){
        return $var ? 'Yes' : 'No';
    }

    public static function messageCounter($new_messages){
        $counter = [];
        foreach ($new_messages as $m){
            $counter[$m['dialog_id']] = $m['cnt'];
        }
        return $counter;
    }

    public static function checkPasswordEquality($user, $old_password, $new_password = '', $pass_confirm = ''){
        $error = false;
        $password = self::formSecurePassword($old_password);
        if($password != $user->password){
            self::alert('Wrong password!');
            $error = true;
        }
        if(!empty($new_password)){
            if ($new_password != $pass_confirm){
                self::alert('New password doesn\'t correspond to confirm!');
                $error = true;
            }
        }
        return $error;
    }

    public static function formSecurePassword($password){
        if (!empty($password)) return md5($password . \AppConfig\SALT);
    }

    public static function vd($params){
        var_dump($params);
        exit;
    }

}