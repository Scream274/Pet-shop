<?php

namespace models;

use Myapp\DBContext;

class RoleModel extends DBContext
{
    public function __construct()
    {
        parent::__construct("roles");
    }

    public function getRoleName($role_id)
    {
        $query = "SELECT role_value FROM roles WHERE id = $role_id";
        return $this->executeQuery($query);
    }

    public function getAllRoles()
    {
        return $this->getManyRows();
    }

}