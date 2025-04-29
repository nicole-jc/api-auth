<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index']); // Route to get all users

Route::get('/users/{user}', [UserController::class, 'show']); // Route to get a unique user

Route::get('/user/me', [UserController::class, 'user'])
    ->middleware('auth:sanctum'); // Route to get the user currently logged
    
Route::put('/user/me', [UserController::class, 'update'])
    ->middleware('auth:sanctum'); // Route to update logged user info

Route::delete('/user/me', [UserController::class, 'destroy'])
    ->middleware('auth:sanctum'); // Route to delete logged user account
    
require __DIR__.'/auth.php';