<?php

namespace Myapp;

class AdminKernel
{
    private static $router;

    public static function init()
    {
        self::$router = new AdminRouter();
        self::$router->start();
    }
}