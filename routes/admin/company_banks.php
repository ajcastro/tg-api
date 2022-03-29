<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('company_banks', App\Http\Controllers\Api\Admin\CompanyBankController::class);
Route::post('company_banks/{company_bank}/set_active', [App\Http\Controllers\Api\Admin\CompanyBankController::class, 'setActiveStatus'])->name('company_banks.set_active');
