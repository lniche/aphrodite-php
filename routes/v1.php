<?php

use Illuminate\Support\Facades\Route;



Route::get('/', [\App\Http\Controllers\HealthController::class, 'root'])->name('root');
Route::get('/ping', [\App\Http\Controllers\HealthController::class, 'ping'])->name('ping');

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::middleware('guest:users')->group(function () {
            Route::post('/send-code', [\App\Http\Controllers\V1\AuthController::class, 'sendVerifyCode'])->name('sendVerifyCode');
            Route::post('/login', [\App\Http\Controllers\V1\AuthController::class, 'login'])->name('login');
        });
        Route::middleware('auth:users')->group(function () {
            Route::post('/logout', [\App\Http\Controllers\V1\AuthController::class, 'logout'])->name('logout');
        });
    });
    Route::prefix('user')->group(function () {
        Route::middleware('auth:users')->group(function () {
            Route::get('/', [\App\Http\Controllers\V1\UserController::class, 'get'])->name('get');
            Route::put('/', [\App\Http\Controllers\V1\UserController::class, 'update'])->name('update');
            Route::delete('/', [\App\Http\Controllers\V1\UserController::class, 'delete'])->name('delete');
        });
    });
});
