<?php

use App\Http\Route;

Route::get('/', 'UserController@index');
Route::get('/about/{id}', 'UserController@index');