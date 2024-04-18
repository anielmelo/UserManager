<?php

namespace App\Models;

class Database {
    public static function getConnection() {
        $host = $_ENV['HOST_DATABASE'];
        $database = $_ENV['NAME_DATABASE'];
        $username = $_ENV['USERNAME_DATABASE'];
        $password = $_ENV['PASSWORD_DATABASE'];
        
        $connection = new \PDO("mysql:host={$host};dbname={$database}", $username, $password);

        return $connection;
    }
}