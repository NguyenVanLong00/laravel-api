<?php

use App\Enums\Permission;
use App\Http\Controllers\RoleController;
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
        Route::get('permissions', 'permissions')->name('permissions');
        Route::post('logout', 'logout')->name('logout');
    });

    Route::prefix('roles')
        ->middleware(Permission::SA_ROLE->pattern())
        ->controller(RoleController::class)->group(function () {

            Route::get('', 'roles')->name('list role');
            Route::post('', 'create')->name('create role');
            Route::get('permissions', 'permissions')->name('list permissions');
            Route::get('{role:name}/permissions', 'rolePermissions');
            Route::post('{role:name}/attach-permissions', 'attachPermissionToRole');
            Route::post('{role:name}/assign/{user}', 'assignRoleToUser')->name('assign role for user');
        });

    Route::prefix('users')->controller(UserController::class)->group(function () {
        Route::get('', 'index')->name('list user')->middleware(Permission::VIEW_USER->pattern());
        Route::post('', 'create')->name('create user')->middleware(Permission::CREATE_USER->pattern());
    });
});
