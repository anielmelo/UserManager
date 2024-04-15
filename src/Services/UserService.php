<?php

namespace App\Services;

use App\Utils\Validator;
use App\Models\User;

class UserService {
    public static function create(array $data) {
        try {
            $fields = Validator::validate([
                'name' => $data['name'] ?? '',
                'email' => $data['email'] ?? '',
                'password' => $data['password'] ?? ''
            ]);

            $fields['password'] = password_hash($fields['password'], PASSWORD_DEFAULT);

            $user = User::save($fields);

            if (!$user) return [ 'error' => 'User could not be created!' ];
            
            return 'User successfully created!';

        } catch (\PDOException $e) {
            if ($e->errorInfo[0] === '23505') return [ 'error' => 'User already exists!' ];
            return [ 'error' => 'Sorry, internal error.' ];
        } catch (\Exception $e) {
            return [ 'error' => $e->getMessage() ];
        }
    }
}