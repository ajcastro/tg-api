<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('users', App\Http\Controllers\Api\Admin\UserController::class);
Route::post('users/{client}/set_active', [App\Http\Controllers\Api\Admin\UserController::class, 'setActiveStatus'])->name('users.set_active');
