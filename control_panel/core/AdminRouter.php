<?php

namespace Myapp;

class AdminRouter
{
    private $defaultController = __NAMESPACE__ . "\\" . "AdminController";
    private $errorController = __NAMESPACE__ . "\\" . "AdminErrorController";
    private $defaultAction = "index";
    private $controllerName = null;
    private $actionName = null;
    private $controller = null;

    public function start()
    {
        $route = $_SERVER['REQUEST_URI'];
        $route = explode('?', $route)[0];
        $routes = explode('/', $route);

        if (empty($routes[2])) {
            $this->controllerName = $this->defaultController;
        } else {
            $this->controllerName = ucfirst(mb_strtolower($routes[2]) . "Controller");
            if (file_exists(ADM_CONTROL_PATH . $this->controllerName . EXT)) {
                $this->controllerName = __NAMESPACE__ . "\\" . $this->controllerName;
            } else {
                $this->controllerName = $this->errorController;
            }
        }
        $this->controller = new $this->controllerName();

        //action
        $this->actionName = $this->defaultAction;
        if (!empty($routes[3])) {
            if (method_exists($this->controller, mb_strtolower($routes[3]))) {
                $this->actionName = mb_strtolower($routes[3]);
            } else {
                $this->controllerName = $this->errorController;
                $this->controller = new $this->controllerName();
            }
        }
        $this->controller->call($this->actionName);
    }
}