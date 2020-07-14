<?php
/**
 * :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
 *
 * Copyright (c) 2020
 * All Rights Reserved
 * Licensed use only
 *
 * This product is part of the SheepCompany Incorporated
 *
 *
 * LICENSE BY:
 * Artificial Intelligence :: Sheep-AI.com
 * More information: LICENSE.txt
 *
 * :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
 */

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('hue/auth', '\App\Http\Controllers\API\HueController@auth')->middleware('web');
Route::get('hue/auth/receive', '\App\Http\Controllers\API\HueController@receive')->middleware('web');

Route::middleware(['cors', 'json.response', 'auth:api'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['cors', 'json.response']], function () {

    Route::post('/login', 'API\Auth\ApiAuthController@login')->name('login.api');
    Route::post('/register', 'API\Auth\ApiAuthController@register')->name('register.api');
    Route::post('/logout', 'API\Auth\ApiAuthController@logout')->name('logout.api');

    Route::middleware('auth:api')->group(function() {
        Route::get('/themes', 'ThemeController@index')->middleware('api.admin')->name('themes');

        Route::apiResources([
            'users' => 'UserController',
            'lights' => 'LightController',
            'rooms' => 'RoomController',
            'sensors' => 'SensorController',
            'resourcelinks' => 'ResourceLinkController',
            'bridge' => 'BridgeController',
            'preferences' => 'UserPreferencesController',
            'scenes' => 'SceneController'
        ]);

        Route::put('lights/{id}/toggle', 'LightController@toggle');
        Route::put('lights/{id}/state', 'LightController@update');
        Route::put('rooms/{id}/toggle', 'RoomController@toggle');
        Route::put('rooms/{id}/state', 'RoomController@updateState');
    });

    Route::middleware('api.admin')->group(function() {
        Route::apiResources(['themes' => 'ThemeController']);
    });
    Route::get('/themes', 'ThemeController@index')->middleware('api.admin')->name('themes');

});

