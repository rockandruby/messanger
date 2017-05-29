<?php

class Dialog extends Base
{
    public static $table = 'dialogs';

    public static function userDialogs($user_id){
        $query = self::connect()->query('SELECT d.id,
        (CASE 
        WHEN d.user_id != '.$user_id.'
        THEN (SELECT name FROM users WHERE id = d.user_id)
        WHEN d.current_user_id != '.$user_id.'
        THEN (SELECT name FROM users WHERE id = d.current_user_id)
        END) as name
        FROM '.self::$table. ' d 
        WHERE current_user_id = '.$user_id.' OR user_id = '.$user_id);
        return $query->fetchAll();
    }

    public static function findUserDialog($user_id, $companion_id){
        $query = self::connect()->prepare('SELECT id FROM '.self::$table.' WHERE (current_user_id = '.$user_id.
            ' AND user_id = ?) OR (current_user_id = ? AND user_id = '.$user_id.')');
        $query->execute([$companion_id, $companion_id]);
        return $query->fetch();
    }

}
