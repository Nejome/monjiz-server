<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\ProviderController;

Route::post('/users/login', [UserController::class, 'login']);

Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/providers', [ProviderController::class, 'index']);

Route::post('/providers/register', [ProviderController::class, 'register']);

Route::middleware('auth:sanctum')->group( function () {

    Route::get('/users/logout', [UserController::class, 'logout']);

    Route::get('/providers/profile', [ProviderController::class, 'profile']);

    Route::post('/providers/profile', [ProviderController::class, 'updateProfile']);

});
