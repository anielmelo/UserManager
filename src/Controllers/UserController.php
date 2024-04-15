<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Services\UserService;

class UserController {

    public static function index(Request $request, Response $response) {
        return $response::json([
            "error"   => "false",
            "success" => "true",
            "message" => "Hello world!"
        ], 200);
    }

    public static function insert(Request $request, Response $response) {
        $body = $request::body();

        $responseUser = UserService::create($body);

        if(isset($responseUser['error'])) {
            return $response::json([
                "error"   => "true",
                "success" => "false",
                "data" => $responseUser['error']
            ], 400);
        }

        $response::json([
            "error"   => "false",
            "success" => "true",
            "data" => $responseUser
        ], 201);
    }

    public static function fetch(Request $request, Response $response) {}
    public static function update(Request $request, Response $response) {}
    public static function delete(Request $request, Response $response) {}
}
