<?php

class Base
{

    public static function all(){
        $query = self::connect()->query('SELECT * FROM '.static::$table);
        return $query->fetchAll();
    }

    public static function create($params)
    {
        $query = self::connect()->prepare("INSERT INTO ".static::$table." (" .
            implode(',', array_keys($params)) . ") VALUES (" . implode(',', array_fill(0, count($params), '?')) . ")");
        $query->execute(array_values($params));
        return self::connect()->lastInsertId();
    }

    public static function find($id){
        $query = self::connect()->prepare('SELECT * FROM '.static::$table.' WHERE id= ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_LAZY);
    }

    public static function update($id, $params){
        $query_string = implode('=?,',array_keys($params)).'=?';
        $values = array_values($params);
        array_push($values, $id);
        $query = self::connect()->prepare("UPDATE ".static::$table." SET $query_string WHERE id=?");
        return $query->execute($values);
    }

    public static function delete($id){
        $query = self::connect()->prepare("DELETE FROM ".static::$table." WHERE id=?");
        return $query->execute([$id]);
    }

    protected static function requiredFieldsValidator($params){
        if(!empty(static::$necessary_fields)){
            if(count(array_intersect(static::$necessary_fields, array_keys($params))) != count(static::$necessary_fields)){
                return ['error' => true, 'message' => "Necessary fields (".implode(',',array_diff(static::$necessary_fields, array_keys($params))).") are missing" ];
            }
        }
    }

    protected static function connect()
    {
        return \Core\Database::connect();
    }

}