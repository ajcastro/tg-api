<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('clients', App\Http\Controllers\Api\Admin\ClientController::class);
Route::post('clients/{client}/set_active', [App\Http\Controllers\Api\Admin\ClientController::class, 'setActiveStatus'])->name('clients.set_active');
