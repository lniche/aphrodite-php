<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Website API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your website. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('index');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Here is where you can register auth routes for your application. These
| routes are helpful when building the login and registration screens
| for your application.
|
*/

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