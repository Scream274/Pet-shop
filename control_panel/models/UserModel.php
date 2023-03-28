<?php

namespace models;

use Myapp\DBContext;

class UserModel extends DBContext
{
    public function __construct()
    {
        parent::__construct("users");
    }

    public function getUser($email, $password)
    {
        $users = $this->getManyRows([
            'email' => $email,
            'password' => $password
        ]);

        return count($users) == 1 ? $users[0] : null;
    }

    public function addUser($login, $email, $password)
    {
        $this->addOneRow([
            'login' => $login,
            'email' => $email,
            'password' => $password
        ]);
    }

}