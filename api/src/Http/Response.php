<?php

namespace App\Http;

class Response {
    public static function json(array $data = [], int $status = 200) {
        http_response_code($status);
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: *");
        echo json_encode($data);
    }
}