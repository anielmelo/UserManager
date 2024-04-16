<?php

namespace App\Services;

use App\Http\JWT;
use App\Http\Request;
use App\Utils\Validator;
use App\Models\User;

class UserService {
    public static function create(array $data) {
        try {
            $fields = Validator::validate([
                'name'     => $data['name'] ?? '',
                'email'    => $data['email'] ?? '',
                'password' => $data['password'] ?? ''
            ]);

            $fields['password'] = password_hash($fields['password'], PASSWORD_DEFAULT);

            $user = User::save($fields);

            if (!$user) return [ 'error' => 'User could not be created!' ];
            
            return 'User successfully created!';

        } catch (\PDOException $e) {
            if ($e->errorInfo[0] === '23000') return [ 'error' => 'User already exists!' ];
            return [ 'error' => $e->getMessage() ];
        } catch (\Exception $e) {
            return [ 'error' => $e->getMessage() ];
        }
    }

    public static function auth(array $data) {
        try {
            $fields = Validator::validate([
                'email' => $data['email'] ?? '',
                'password' => $data['password'] ?? ''
            ]);

            $user = User::authenticate($fields);

            if (!$user) return [ 'error' => 'User not authenticated!' ];

            return JWT::generate($user);

        } catch (\PDOException $e) {
            return [ 'error' => $e->getMessage() ];
        } catch (\Exception $e) {
            return [ 'error' => $e->getMessage() ];
        }
    }

    public static function fetch(mixed $authorization) {
        try {
            if (isset($authorization['error'])) {
                return ['error' => $authorization['error']];
            }

            $payload = JWT::verify($authorization);

            if (!$payload) return [ 'error' => 'Please, login to access!' ];

            $user = User::find($payload['id']);

            if (!$user) return [ 'error' => 'User not found!' ];

            return $user;

        } catch (\PDOException $e) {
            return [ 'error' => $e->getMessage() ];
        } catch (\Exception $e) {
            return [ 'error' => $e->getMessage() ];
        }
    }
}