<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin/login');
});

Route::middleware("guest.admin:admin")->group(function() {
    Route::get('login', [\App\Http\Controllers\Admin\AuthController::class, 'loginForm'])->name('login');
    Route::post('login_process', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login_process');

    Route::get('register', [\App\Http\Controllers\Admin\AuthController::class, 'registerForm'])->name('register');
    Route::post('register_process', [\App\Http\Controllers\Admin\AuthController::class, 'register'])->name('register_process');
});

Route::middleware("auth.admin:admin")->group(function() {
    Route::get('logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

    Route::resource('tasks', \App\Http\Controllers\Admin\TaskController::class)->except([
        'show'
    ]);

    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->only([
        'index', 'destroy'
    ]);
});