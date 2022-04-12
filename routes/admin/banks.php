<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('banks', App\Http\Controllers\Api\Admin\BankController::class);
Route::post('banks/{bank}/set_active', [App\Http\Controllers\Api\Admin\BankController::class, 'setActiveStatus'])->name('banks.set_active');
