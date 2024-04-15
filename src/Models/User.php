<?php

namespace App\Models;

use App\Models\Database;

class User extends Database {

    public static function save(array $data) {
        $connection = self::getConnection();

        $statement = $connection->prepare(
            "INSERT users (name, email, password) INTO VALUES(?, ?, ?);"
        );

        $statement->execute([
            $data['name'],
            $data['email'],
            $data['password']
        ]);

        return $connection->lastInsertId() > 0 ? true : false;
    }
}