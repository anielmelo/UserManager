<?php

namespace App\Http;

class Request {
    public static function method() {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function body() {
        $json = json_decode(file_get_contents('php://input'), true) ?? [];

        $data = match (self::method()) {
            'GET' => $_GET,
            'POST', 'PUT', 'DELETE' => $json
        };

        return $data;
    }

    public static function authorization() {
        if (!isset($_SERVER['HTTP_AUTHORIZATION'])) return [ 'error' => 'Authorization header not provided!' ];

        $authorization = $_SERVER['HTTP_AUTHORIZATION'];
    
        $tokenPartials = explode(' ', $authorization);
    
        if (count($tokenPartials) !== 2) return [ 'error' => 'Provide a valid authorization header!' ];
    
        return $tokenPartials[1] ?? '';
    }
}
