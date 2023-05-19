<?php

namespace Myapp;

use models\UserModel;
use models\RoleModel;

class UserController extends Controller
{
    public function index()
    {
    }

    public function getAllUsers()
    {
        $userM = new UserModel();
        $this->data['users'] = $userM->getAllUsers();

        $roleM = new RoleModel();
        $this->data['roles'] = $roleM->getAllRoles();
        foreach ($this->data['users'] as &$user) {
            $role_id = $user['role_id'];
            $role_name = $roleM->getRoleName($role_id);
            if (!empty($role_name[0]['role_value'])) {
                $user['role_name'] = $role_name[0]['role_value'];
            } else {
                $user['role_name'] = ''; // или другое значение по умолчанию
            }
        }

        if ($this->userAuth->isAuth()) {
            AdminView::render(ADM_PAGES_PATH . 'allusers' . EXT, $this->data);
        } else {
            $this->login();
        }
    }

    public function deleteUser()
    {
        if ($this->userAuth->isAuth()) {
            if ($_SERVER['REQUEST_METHOD'] == "GET") {
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $userM = new UserModel();

                    if ($userM->getUserById($id)['role_id'] == 3) {
                        $this->data['error'] = "Error. You cant delete Admin.";
                        $this->getAllUsers();
                    } else {
                        if ($userM->deleteUser($id)) {
                            $this->data['success'] = "User deleted";
                            $this->getFormatOptions();
                        } else {
                            $this->data['error'] = "Error. User was not deleted.";
                        }
                        $this->getAllUsers();
                    }
                }
            }
        } else {
            $this->login();
        }
    }

    public function updateUser()
    {
        if ($this->userAuth->isAuth()) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if (isset($_POST['Id']) && isset($_POST['login']) && isset($_POST['email']) && isset($_POST['role'])) {
                    $id = intval(htmlspecialchars(trim($_POST['Id'])));
                    $login = htmlspecialchars(trim($_POST['login']));
                    $email = htmlspecialchars(trim($_POST['email']));
                    $role = htmlspecialchars(trim($_POST['role']));

                    $userM = new UserModel();
                    if ($userM->updateUser($id, $login, $email, $role)) {
                        $this->data['success'] = "User updated";
                        $this->getFormatOptions();
                    } else {
                        $this->data['error'] = "Error. User was not updated. ";
                    }
                    $this->getAllUsers();
                }
            }
        } else {
            $this->login();
        }
    }

    public function createUser()
    {
        if ($this->userAuth->isAuth()) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['role'])) {
                    $login = htmlspecialchars(trim($_POST['login']));
                    $email = htmlspecialchars(trim($_POST['email']));
                    $password = htmlspecialchars(trim($_POST['password']));
                    $role = htmlspecialchars(trim($_POST['role']));
                    $password = hash('sha256', $password);

                    $userM = new UserModel();
                    if ($userM->addNewUser($login, $email, $password, $role)) {
                        $this->data['success'] = "User added";
                        $this->getFormatOptions();
                    } else {
                        $this->data['error'] = "Error. User was not added. ";
                    }
                    $this->getAllUsers();
                }
            }
        } else {
            $this->login();
        }
    }

}