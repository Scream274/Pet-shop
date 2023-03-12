<?php

namespace Myapp;

class Router
{
    private $defaultController = __NAMESPACE__ . "\\" . "MainController";
    private $errorController = __NAMESPACE__ . "\\" . "ErrorController";
    private $defaultAction = "index";
    private $controllerName = null;
    private $actionName = null;
    private $controller = null;

    public function start()
    {
        $route = $_SERVER["REQUEST_URI"];
        $route = explode("?", $route)[0];

        $routes = explode("/", $route);
        if (empty($routes[1])) {
            $this->controllerName = $this->defaultController;
        } else {
            $this->controllerName = ucfirst(mb_strtolower($routes[1]) . "Controller");
            if (file_exists(CONTROLLERS_PATH . $this->controllerName . EXT)) {
                $this->controllerName = __NAMESPACE__ . "\\" . $this->controllerName;
            } else {
                $this->controllerName = $this->errorController;
            }
        }
        $this->controller = new $this->controllerName();

        //action
        $this->actionName = $this->defaultAction;
        if (!empty($routes[2])) {
            if (method_exists($this->controller, mb_strtolower($routes[2]))) {
                $this->actionName = mb_strtolower($routes[2]);
            } else {
                $this->controllerName = $this->errorController;
                $this->controller = new $this->controllerName();
            }
        }
        $this->controller->call($this->actionName);
    }
}