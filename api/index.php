<?php

require_once __DIR__ ."/vendor/autoload.php";
require_once __DIR__ ."/src/routes/main.php";

use App\Core\Core;
use App\Http\Route;
use Dotenv\Dotenv;

$path = dirname(__FILE__, 1);

$dotenv = Dotenv::createImmutable($path);
$dotenv->load();

Core::dispatch(Route::routes());
