<?php

namespace app\models;

use PDO;
use PDOException;

class Connection 
{
    private static $connection;

    public static function connection()
    {
        try {
            if (static::$connection) {
                return static::$connection;
            }
            static::$connection = new PDO("mysql:host=localhost;port=3306;dbname=university", "root", "Mysql@01");
            return static::$connection;
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}