<?php

namespace Myapp;

class ConfigController extends Controller
{
    public function index()
    {
    }

    public function getAllOptions()
    {
        if ($this->userAuth->isAuth()) {
            AdminView::render(ADM_PAGES_PATH . 'alloptions' . EXT, $this->data);
        } else {
            $this->login();
        }
    }

    public function updateOption()
    {
        if ($this->userAuth->isAuth()) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if (isset($_POST['Id']) && isset($_POST['name']) && isset($_POST['value']) && isset($_POST['group'])) {
                    $id = intval(htmlspecialchars(trim($_POST['Id'])));
                    $name = htmlspecialchars(trim($_POST['name']));
                    $value = htmlspecialchars(trim($_POST['value']));
                    $group = htmlspecialchars(trim($_POST['group']));

                    $optM = new OptionsModel();
                    if ($optM->updateOption($id, $name, $value, $group)) {
                        $this->data['success'] = "Options updated";
                        $this->getFormatOptions();
                    } else {
                        $this->data['error'] = "Error. Options was not updated. ";
                    }
                    $this->getAllOptions();
                }
            }
        } else {
            $this->login();
        }
    }

    public function createOption()
    {
        if ($this->userAuth->isAuth()) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if (isset($_POST['name']) && isset($_POST['value']) && isset($_POST['group'])) {

                    $name = htmlspecialchars(trim($_POST['name']));
                    $value = htmlspecialchars(trim($_POST['value']));
                    $group = htmlspecialchars(trim($_POST['group']));

                    $optM = new OptionsModel();
                    if ($optM->createOption($name, $value, $group)) {
                        $this->data['success'] = "Options created";
                        $this->getFormatOptions();
                    } else {
                        $this->data['error'] = "Error. Options was not created. ";
                    }
                    $this->getAllOptions();
                }
            }
        } else {
            $this->login();
        }
    }

    public function deleteOption()
    {
        if ($this->userAuth->isAuth()) {
            if ($_SERVER['REQUEST_METHOD'] == "GET") {
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $isSystem = $_GET['isSystem'];
                    $optM = new OptionsModel();

                    if ($optM->deleteOption($id)) {
                        $this->data['success'] = "Options deleted";
                        $this->getFormatOptions();
                    } else {
                        $this->data['error'] = "Error. Options was not deleted.";
                    }
                    $this->getAllOptions();
                }
            }
        } else {
            $this->login();
        }
    }
}