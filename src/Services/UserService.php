<?php

namespace App\Services;

use App\Http\JWT;
use App\Utils\Validator;
use App\Models\User;

class UserService {
    public static function create(array $data) {
        try {
            $fields = Validator::validate([
                'name'     => $data['name']     ?? '',
                'email'    => $data['email']    ?? '',
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
                return ['unauthorized' => $authorization['error']];
            }

            $payload = JWT::verify($authorization);

            if (!$payload) return [ 'unauthorized' => 'Please, login to access this feature!' ];

            $user = User::find($payload['id']);

            if (!$user) return [ 'error' => 'User not found!' ];

            return $user;

        } catch (\PDOException $e) {
            return [ 'error' => $e->getMessage() ];
        } catch (\Exception $e) {
            return [ 'error' => $e->getMessage() ];
        }
    }

    public static function update(array $data, mixed $authorization) {
        try {
            if (isset($authorization['error'])) {
                return ['unauthorized' => $authorization['error']];
            }

            $payload = JWT::verify($authorization);

            if (!$payload) return [ 'unauthorized' => 'Please, login to access this feature!' ];

            $fields = Validator::validate([
                'name'     => $data['name']     ?? '',
                'email'    => $data['email']    ?? '',
                'password' => $data['password'] ?? ''
            ]);

            $fields['password'] = password_hash($fields['password'], PASSWORD_DEFAULT);

            $user = User::update($payload['id'], $fields);

            if (!$user) return [ 'error' => 'User could not be updated!' ];

            return 'User successfully updated!';

        } catch (\PDOException $e) {
            return [ 'error' => $e->getMessage() ];
        } catch (\Exception $e) {
            return [ 'error' => $e->getMessage() ];
        }
    }

    public static function remove(mixed $authorization) {
        try {
            if (isset($authorization['error'])) {
                return [ 'unauthorized' => $authorization['error'] ];
            }

            $payload = JWT::verify($authorization);

            if (!$payload) return [ 'unauthorized' => 'Please, login to access this feature!' ];

            $user = User::remove($payload['id']);

            if (!$user) return [ 'error' => 'User could not be removed!' ];

            return 'User successfully removed!';

        } catch (\PDOException $e) {
            return [ 'error' => $e->getMessage() ];
        } catch (\Exception $e) {
            return [ 'error' => $e->getMessage() ];
        }
    }
}