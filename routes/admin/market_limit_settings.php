<?php

use Illuminate\Support\Facades\Route;

Route::get('market_limit_settings/{website}', [App\Http\Controllers\Api\Admin\MarketLimitSettingController::class, 'index'])->name('market_limit_settings.index');
Route::post('market_limit_settings/{website}', [App\Http\Controllers\Api\Admin\MarketLimitSettingController::class, 'store'])->name('market_limit_settings.store');
