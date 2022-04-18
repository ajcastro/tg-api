<?php

use Illuminate\Support\Facades\Route;

Route::get('referral_settings/{website}', [App\Http\Controllers\Api\Admin\ReferralSettingController::class, 'index'])->name('referral_settings.index');
Route::post('referral_settings/{website}', [App\Http\Controllers\Api\Admin\ReferralSettingController::class, 'store'])->name('referral_settings.store');
