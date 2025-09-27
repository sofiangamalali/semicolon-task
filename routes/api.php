<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\PermissionController;

Route::post('login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(
    function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::apiResource('users', UserController::class);
        Route::post('users/{user}/assign-groups', [UserController::class, 'assignGroups']);
        Route::delete('users/{user}/remove-groups', [UserController::class, 'removeGroups']);

        Route::middleware(['admin'])->group(
            function () {
                Route::post('groups', [GroupController::class, 'create']);
            }
        );
      
        Route::apiResource('groups', GroupController::class)->except(['create']);
        Route::post('groups/{group}/assign-permissions', [GroupController::class, 'assignPermissions']);
        Route::delete('groups/{group}/remove-permissions', [GroupController::class, 'removePermissions']);
        Route::get('permissions', [PermissionController::class, 'index']);
    }

);
