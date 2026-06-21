<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{project:slug}', [ProjectController::class, 'show']);
