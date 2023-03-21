<?php

namespace Myapp;

class UserAuth
{
    private $currentUser = null;

    public function isAuth(){
        return false;
    }

    public function getCurrentUser(){
        return $this->currentUser;
    }

    public function isValidUser($email, $password){

    }

}