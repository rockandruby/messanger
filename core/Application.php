<?php
namespace Core;

class Application
{
    public static function run()
    {
        $url_parts = array_values(array_filter(explode('/', $_SERVER['REQUEST_URI'])));

        if (empty($url_parts)) $url_parts = explode('#', 'Home#index');

        session_start();

        $klass = ucfirst($url_parts[0]) . 'Controller';

        $controller = new $klass;
        $action = $url_parts[1];
        $params = array_slice($url_parts, 2);

        call_user_func_array([$controller, $action], [$params]);
    }
}
