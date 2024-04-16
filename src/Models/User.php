<?php

namespace App\Models;

use App\Models\Database;

class User extends Database {

    public static function save(array $data) {
        $connection = self::getConnection();

        $statement = $connection->prepare(
            "INSERT INTO users (name, email, password) VALUES(?, ?, ?);"
        );

        $statement->execute([
            $data['name'],
            $data['email'],
            $data['password']
        ]);

        return $connection->lastInsertId() > 0 ? true : false;
    }

    public static function authenticate(array $data) {
        $connection = self::getConnection();

        $statement = $connection->prepare(
            "SELECT * FROM users WHERE email = ?;"
        );

        $statement->execute([
            $data['email']
        ]);

        if ($statement->rowCount() < 1) return false;

        $user = $statement->fetch(\PDO::FETCH_ASSOC);

        if (!\password_verify($data['password'], $user['password'])) return false;

        return [
            'id'    => $user['id'],
            'name'  => $user['name'],
            'email' => $user['email']
        ];
    }

    public static function find(string|int $id) {
        $connection = self::getConnection();

        $statement = $connection->prepare(
            "SELECT id, name, email FROM users WHERE id = ?;"
        );

        $statement->execute([$id]);

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }
}