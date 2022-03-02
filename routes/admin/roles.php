<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('roles', App\Http\Controllers\Api\Admin\RoleController::class);
Route::post('roles/{client}/set_active', [App\Http\Controllers\Api\Admin\RoleController::class, 'setActiveStatus'])->name('roles.set_active');
