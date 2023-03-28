<?php

namespace Myapp;

class AdminController extends Controller
{
    public function index()
    {
        if ($this->userAuth->isAuth()) {
            AdminView::render(ADM_PAGES_PATH . 'adminindex' . EXT, $this->data);
        } else {
            $this->login();
        }
    }

    public function login()
    {
        AdminView::render(ADM_PAGES_PATH . 'login' . EXT, $this->data, ADM_VIEWS_PATH . "no_auth_template_view" . EXT);
    }

    public function register()
    {
        AdminView::render(ADM_PAGES_PATH . 'register' . EXT, $this->data, ADM_VIEWS_PATH . "no_auth_template_view" . EXT);
    }

    public function forgot_password()
    {
        AdminView::render(ADM_PAGES_PATH . 'recover_password' . EXT, $this->data, ADM_VIEWS_PATH . "no_auth_template_view" . EXT);
    }

    public function checkUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_POST['email']) && isset($_POST['password'])){
                //Validation
                $email = htmlspecialchars(trim($_POST['email']));
                $password= htmlspecialchars(trim($_POST['password']));
                if($this->userAuth->isValidUser($email, $password)){
                    //Sessions
                    $_SESSION['IP'] = $_SERVER['REMOTE_ADDR'];
                    $_SESSION['userId'] = $this->userAuth->getCurrentUser()['Id'];

                    $this->index();
                    return;
                }
            }
        }
        $this->data['error'] = 'Error login!';
        $this->login();
    }

    public function logout(){
        unset($_SESSION['IP']);
        unset($_SESSION['userId']);
        session_destroy();
        $this->login();

    }
}