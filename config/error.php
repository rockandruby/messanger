<?php
if($_SERVER["REMOTE_ADDR"]=="127.0.0.1"){
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    ini_set("log_errors", 0);
}else{
    function customHandler(){
        require_once 'public/views/404.html';
    }
    set_error_handler("customHandler");
}