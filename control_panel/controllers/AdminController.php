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
        AdminView::render(ADM_PAGES_PATH . 'login' . EXT, $this->data, ADM_VIEWS_PATH."no_auth_template_view".EXT);
    }

    public function register()
    {
        AdminView::render(ADM_PAGES_PATH . 'register' . EXT, $this->data, ADM_VIEWS_PATH."no_auth_template_view".EXT);
    }

    public function forgot_password()
    {
        AdminView::render(ADM_PAGES_PATH . 'recover_password' . EXT, $this->data, ADM_VIEWS_PATH."no_auth_template_view".EXT);
    }

}