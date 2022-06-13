<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;


Route::post('/users/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group( function () {

    Route::get('/users/logout', [UserController::class, 'logout']);

});
