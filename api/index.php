<?php

require_once __DIR__ ."/vendor/autoload.php";
require_once __DIR__ ."/src/routes/main.php";

use App\Core\Core;
use App\Http\Route;
use Dotenv\Dotenv;

if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-CSRF-Token, X-Requested-With, Accept, Accept-Version, Content-Length, Content-MD5, Content-Type, Date, X-Api-Version");
header("Access-Control-Allow-Methods: GET,OPTIONS,PATCH,DELETE,POST,PUT");
header("Access-Control-Allow-Credentials: true");

Core::dispatch(Route::routes());
