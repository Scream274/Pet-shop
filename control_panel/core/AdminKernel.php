<?php

namespace core;

use Myapp\Router;

class AdminKernel
{
    private static $router;

    public static function init()
    {
        self::$router = new AdminRouter();
        self::$router->start();
    }
}