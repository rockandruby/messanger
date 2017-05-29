<?php
require_once 'config/app.php';
require_once 'config/db.php';
require_once 'config/error.php';
require_once 'core/Database.php';
require_once 'core/Helper.php';

spl_autoload_register(function ($class_name) {
    if (strpos($class_name, 'Controller')) {
        include_once 'controllers/' . $class_name . '.php';
    }else {
        include_once 'models/' . $class_name . '.php';
    }
});
