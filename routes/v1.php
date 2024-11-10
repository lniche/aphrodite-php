<?php

use Illuminate\Support\Facades\Route;



Route::get('/', [\App\Http\Controllers\HealthController::class, 'root'])->name('root');
Route::get('/ping', [\App\Http\Controllers\HealthController::class, 'ping'])->name('ping');


Route::prefix('auth')->group(function () {
    Route::middleware('guest:users')->group(function () {
        Route::post('/register', [\App\Http\Controllers\V1\RegisteredUserController::class, 'store'])->name('register');
        Route::post('/login', [\App\Http\Controllers\V1\AuthController::class, 'store'])->name('login');
    });

    Route::middleware('auth:users')->group(function () {
        Route::get('/me', [\App\Http\Controllers\V1\AuthController::class, 'show'])->name('me');
        Route::delete('/logout', [\App\Http\Controllers\V1\AuthController::class, 'destroy'])->name('logout');
    });
});
