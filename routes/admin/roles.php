<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('roles', App\Http\Controllers\Api\Admin\RoleController::class);
Route::post('roles/{role}/set_active', [App\Http\Controllers\Api\Admin\RoleController::class, 'setActiveStatus'])->name('roles.set_active');
Route::get('roles/{role}/permissions', [App\Http\Controllers\Api\Admin\RoleController::class, 'permissions'])->name('roles.permissions');
Route::post('roles/{role}/set_permissions', [App\Http\Controllers\Api\Admin\RoleController::class, 'setPermissions'])->name('roles.set_permissions');
