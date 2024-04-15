<?php

namespace App\Models;

class Database {
    public static function getConnection() {
        $host = 'localhost';
        $database = 'userManager';
        $username = 'admin';
        $password = 'admin';
        
        $connection = new \PDO("mysql:host={$host};dbname={$database}", $username, $password);

        return $connection;
    }
}