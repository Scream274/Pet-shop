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

    public function getAllUsers()
    {
        return $this->getManyRows();
    }

    public function deleteUser($id)
    {
        return $this->deleteOneRow($id);
    }

    public function getUserById($id)
    {
        return $this->getOneRow($id);
    }

    public function updateUser(int $id, string $login, string $email, $role)
    {
        return $this->updateOneRow($id, [
                'login' => $login,
                'email' => $email,
                'role_id' => $role
            ]) == 1;
    }

    public function addNewUser(string $login, string $email, string $password, string $role)
    {
        return $this->addOneRow([
            'login' => $login,
            'email' => $email,
            'role_id' => $role,
            'password' => $password
        ]);
    }

}