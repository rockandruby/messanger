<?php
namespace Models\Mixins;

trait UserMixin
{
    protected static $necessary_fields = ['name', 'email', 'password'];

    public static function create($params){
        $validator = self::requiredFieldsValidator($params);
        if(isset($validator['error'])) return $validator;
        $query = self::connect()->prepare('SELECT * FROM '.self::$table.' WHERE email = ?');
        $query->execute([$params['email']]);
        if(!$query->fetch()) return parent::create($params);
        return ['error' => true, 'message' => 'Email already exists' ];
    }

    public static function signIn($email, $password){
        $query = self::connect()->prepare('SELECT * FROM '.self::$table.' WHERE email=? AND password=?');
        $query->execute([$email, $password]);
        return $query->fetch();
    }
}