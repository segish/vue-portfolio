<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::post('/api/login', [AuthController::class, 'login']);
    Route::post('/api/logout', [AuthController::class, 'logout'])->middleware('auth');
    Route::get('/api/user', [AuthController::class, 'user'])->middleware('auth');

    Route::middleware('auth')->group(function () {
        Route::post('/api/projects', [ProjectController::class, 'store']);
        Route::put('/api/projects/{project:slug}', [ProjectController::class, 'update']);
        Route::delete('/api/projects/{project:slug}', [ProjectController::class, 'destroy']);
    });
});

Route::view('/{any?}', 'app')->where('any', '.*');
