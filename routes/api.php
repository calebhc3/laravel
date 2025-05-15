<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AdminController;
use Illuminate\Http\Request;

Route::middleware('auth:sanctum')->get('/me', function () {
    return request()->user();
});

Route::middleware(['auth:sanctum'])->get('/users', function () {
    return \App\Models\User::paginate(10);
});

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', function (Request $request) {
        return $request->user();
    });
});

Route::post('/register', [UserController::class, 'store']);

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink']);

Route::post('/reset-password', [ResetPasswordController::class, 'reset']);

Route::middleware(['auth:sanctum', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/users', [AdminController::class, 'index']);
    Route::put('/users/{user}', [AdminController::class, 'update']);
    Route::delete('/users/{user}', [AdminController::class, 'destroy']);
});