<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin/login');
});

Route::get('jobs', [\App\Http\Controllers\TaskController::class, 'createJobs']);
