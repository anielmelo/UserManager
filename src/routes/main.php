<?php

use App\Http\Route;

Route::get('/',                'UserController@index');
Route::post('/users/create',   'UserController@insert');
Route::post('/users/login',    'UserController@login');
Route::get('/users/fetch',     'UserController@fetch');
Route::put('/users/update',    'UserController@update');
Route::delete('/users/delete', 'UserController@delete');