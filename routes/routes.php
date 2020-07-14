<?php

use Illuminate\Support\Facades\Route;

Route::get('user/{user}', [
    'middleware' => ['auth', 'roles'], // A 'roles' middleware must be specified
    'uses' => 'UserController@index',
    'roles' => ['admin', 'user'] // Only an administrator, or a manager can access this route
]);
