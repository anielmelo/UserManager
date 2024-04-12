<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;

class NotFoundController {
    public static function index(Request $request, Response $response) {
        return $response::json([
            "error"   => "true",
            "success" => "false",
            "message" => "Error, route not found!"
        ], 404);
    }
}