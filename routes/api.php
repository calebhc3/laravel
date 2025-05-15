<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\UserController;

Route::middleware('auth:sanctum')->get('/me', function () {
    return request()->user();
});

Route::middleware(['auth:sanctum'])->get('/users', function () {
    return \App\Models\User::paginate(10);
});

Route::post('/register', [UserController::class, 'store']);

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink']);

Route::post('/reset-password', [ResetPasswordController::class, 'reset']);