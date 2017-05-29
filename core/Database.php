<?php

namespace Core;

class Database
{
    private function __construct() {}

    final public static function connect($db_exist = true){

        static $connection;

        if(!isset($connection)){
            try{
                $db_name = $db_exist ? ';dbname='.\DbConfig\DATABASE : '';
                $data = 'mysql:host='.\DbConfig\HOST.$db_name;
                $connection = new \PDO($data,\DbConfig\LOGIN,\DbConfig\PASSWORD);
                $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            }catch (\Exception $e){
                print "Error!: " . $e->getMessage() . "<br/>";
                exit();
            }
        }
        return $connection;
    }
}