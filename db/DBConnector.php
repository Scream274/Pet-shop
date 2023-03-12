<?php

namespace Myapp;

class DBConnector
{
    private static $conn = null;

    public static function openConnection()
    {
        self::$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        return self::$conn;
    }

    public static function closeConnection()
    {
        if (self::$conn != null) {
            mysqli_close(self::$conn);
        }
    }
}