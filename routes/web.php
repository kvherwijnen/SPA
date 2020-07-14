<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/hue/auth', '\App\Http\Controllers\HueController@auth');
Route::get('/hue/auth/receive', '\App\Http\Controllers\HueController@receive');
//Route::view('/', 'main');

Route::get('/{any?}', function() {
    return view('main');
})->where('any', '^(?!api\/)[\/\w\.-]*');
