<?php
require_once 'mixins/UserMixin.php';

class User extends Base
{
    public static $table = 'users';

    use \Models\Mixins\UserMixin;

    public static function activeUsers($id){
        $query = self::connect()->query('SELECT * FROM '.self::$table. ' WHERE active = 1 '.'AND id !='.$id);
        return $query->fetchAll();
    }

}