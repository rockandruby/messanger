<?php

class Message extends Base
{
    public static $table = 'messages';
    protected static $necessary_fields = ['text'];

    public static function getDialogMessages($dialog_id,$user_id){
        $query = self::connect()->query('SELECT u.name , m.text, m.created_at, m.dialog_id FROM '.self::$table.
            ' m INNER JOIN '.User::$table.' u ON m.user_id = u.id WHERE m.dialog_id = '.$dialog_id.' AND user_id = '.$user_id.' OR
             user_id != '.$user_id.' AND m.is_read = 1 AND m.dialog_id = '.$dialog_id.' ORDER BY created_at ASC');
        return $query->fetchAll();
    }

    public static function getNewMessages($dialog_id, $current_user_id){
        $query = self::connect()->query('SELECT u.name , m.id, m.text, m.created_at, m.dialog_id FROM '.self::$table.
            ' m INNER JOIN '.User::$table.' u ON m.user_id = u.id WHERE m.dialog_id = '.$dialog_id.' AND m.user_id !='.$current_user_id.' AND m.is_read = 0 ORDER BY created_at ASC');
        return $query->fetchAll();
    }

    public static function markAsRead($ids){
        $query = self::connect()->query('UPDATE '.self::$table.' SET is_read = 1 WHERE id in ('.implode(',', $ids).')');
        $query->execute();
    }

    public static function countNewMessages($user_id){
        $query = self::connect()->query("SELECT dialog_id, count(*) cnt FROM messanger.messages where dialog_id in
                  (select id from dialogs where current_user_id = $user_id or user_id = $user_id) and is_read = 0 and user_id != $user_id group by dialog_id");
        return $query->fetchAll();
    }

}