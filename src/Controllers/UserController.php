<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;

class UserController {

    public static function index(Request $request, Response $response, array $matches) {
        return $response::json([
            "error"   => "false",
            "success" => "true",
            "message" => "Hello world!"
        ], 200);
    }
}