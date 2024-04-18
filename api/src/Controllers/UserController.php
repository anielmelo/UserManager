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
            "message" => 'Hello world!'
        ], 200);
    }

    public static function insert(Request $request, Response $response) {
        $body = $request::body();

        $responseUser = UserService::create($body);

        if(isset($responseUser['error'])) {
            return $response::json([
                "error"   => "true",
                "success" => "false",
                "message" => $responseUser['error']
            ], 400);
        }

        $response::json([
            "error"   => "false",
            "success" => "true",
            "data"    => $responseUser
        ], 201);
    } 

    public static function login(Request $request, Response $response) {
        $body = $request::body();

        $responseUser = UserService::auth($body);

        if(isset($responseUser['error'])) {
            return $response::json([
                "error"   => "true",
                "success" => "false",
                "message" => $responseUser['error']
            ], 400);
        }

        $response::json([
            "error"   => "false",
            "success" => "true",
            "jwt"     => $responseUser
        ], 200);

        return;
    }

    public static function fetch(Request $request, Response $response) {
        $authorization = $request::authorization();

        $responseUser = UserService::fetch($authorization);

        if(isset($responseUser['unauthorized'])) {
            return $response::json([
                "error"   => "true",
                "success" => "false",
                "message" => $responseUser['unauthorized']
            ], 401);
        }

        if(isset($responseUser['error'])) {
            return $response::json([
                "error"   => "true",
                "success" => "false",
                "message" => $responseUser['error']
            ], 400);
        }

        $response::json([
            "error"   => "false",
            "success" => "true",
            "jwt"     => $responseUser
        ], 200);

        return;
    }

    public static function update(Request $request, Response $response) {
        $authorization = $request::authorization();
        $body = $request::body();

        $responseUser = UserService::update($body, $authorization);

        if(isset($responseUser['unauthorized'])) {
            return $response::json([
                "error"   => "true",
                "success" => "false",
                "message" => $responseUser['unauthorized']
            ], 401);
        }

        if(isset($responseUser['error'])) {
            return $response::json([
                "error"   => "true",
                "success" => "false",
                "message" => $responseUser['error']
            ], 400);
        }

        $response::json([
            "error"       => "false",
            "success"     => "true",
            "message"     => $responseUser
        ], 200);

        return;
    }

    public static function delete(Request $request, Response $response) {
        $authorization = $request::authorization();

        $responseUser = UserService::remove($authorization);

        if(isset($responseUser['unauthorized'])) {
            return $response::json([
                "error"   => "true",
                "success" => "false",
                "message" => $responseUser['unauthorized']
            ], 401);
        }

        if(isset($responseUser['error'])) {
            return $response::json([
                "error"   => "true",
                "success" => "false",
                "message" => $responseUser['error']
            ], 400);
        }

        $response::json([
            "error"       => "false",
            "success"     => "true",
            "message"     => $responseUser
        ], 200);

        return;
    }
}
