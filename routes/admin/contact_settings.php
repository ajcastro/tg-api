<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('contact_settings', App\Http\Controllers\Api\Admin\ContactSettingController::class);
Route::post('contact_settings/{contact_setting}/set_active', [App\Http\Controllers\Api\Admin\ContactSettingController::class, 'setActiveStatus'])->name('contact_settings.set_active');
