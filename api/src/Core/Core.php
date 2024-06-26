<?php

namespace App\Core;

use App\Http\Request;
use App\Http\Response;

class Core {
    public static function dispatch(array $routes) {
        $url = $_SERVER['REQUEST_URI'];

        if (strpos($url, '/userManager/api') !== false) {
            $url = str_replace('/userManager/api', '', $url);
        }
        
        $url !== '/' && $url = rtrim($url, '/');

        $prefixController = 'App\\Controllers\\';
        $routeFound = false;

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            Response::json([], 200);
            return;
        }

        foreach ($routes as $route) {
            $pattern = '#^' . preg_replace('/{id}/', '([\w-]+)', $route['path']) . '$#';

            if (preg_match($pattern, $url, $matches)) {
                $routeFound = true;

                array_shift($matches);

                if ($route['method'] !== Request::method()) {
                    Response::json([
                        "error"   => "true",
                        "success" => "false",
                        "message" => "Error, method not allowed!"
                    ], 405);
                    return;
                }
                
                [$controller, $action] = explode('@', $route['action']);

                $controller = $prefixController . $controller;
                $controller;
                $extendController = new $controller();
                return $extendController->$action(new Request, new Response, $matches);
            }
        }

        if (!$routeFound) {
            $controller = $prefixController . 'NotFoundController';
            $extendController = new $controller();
            $extendController->index(new Request, new Response);
        }
    }
}
