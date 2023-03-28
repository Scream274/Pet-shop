<?php

namespace Myapp;

use models\UserModel;

class UserAuth
{
    private $currentUser = null;

    public function isAuth()
    {
       return (isset($_SESSION['IP'])
           && isset($_SESSION['userId'])
           && isset($_SESSION['login']));
    }

    public function getCurrentUser()
    {
        return $this->currentUser;
    }

    public function isValidUser($email, $password)
    {
        $userModel = new UserModel();
        $this->currentUser = $userModel->getUser($email, $password);
        return (!is_null($this->currentUser));
    }

}