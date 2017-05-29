<?php

class HomeController extends ApplicationController
{

    function index(){
        if($id = $this->isAuthed()){
            $users = User::activeUsers($id);
        }else{
            $users = User::all();
        }

        $this->view('home/index', ['users' => $users]);
    }
}