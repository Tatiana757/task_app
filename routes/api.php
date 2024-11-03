<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::prefix('v1')->group(function () {
        Route::post('auth/login', [App\Http\Controllers\API\V1\AuthController::class, 'login']);

        Route::middleware('jwt')->group(function () {
            Route::get('auth/logout', 'App\Http\Controllers\API\V1\AuthController@logout');
        
            Route::get('tasks', 'App\Http\Controllers\API\V1\TaskController@getTasks');
            Route::get('task/{task}', 'App\Http\Controllers\API\V1\TaskController@getTaskById');
        });
    });
});