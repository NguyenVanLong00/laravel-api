<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('api')->prefix('auth')->group(function () {
    Route::post('login', [UserController::class, 'login'])->name('login');
    Route::post('register', [UserController::class, 'register'])->name('register');
});

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('auth')->controller(UserController::class)->group(function () {
        Route::get('roles', 'roles')->name('roles');
        Route::post('logout', 'logout')->name('logout');
    });

});
