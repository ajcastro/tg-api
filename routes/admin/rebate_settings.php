<?php

use Illuminate\Support\Facades\Route;

Route::get('rebate_settings/{website}', [App\Http\Controllers\Api\Admin\RebateSettingController::class, 'index'])->name('rebate_settings.index');
Route::post('rebate_settings/{website}', [App\Http\Controllers\Api\Admin\RebateSettingController::class, 'store'])->name('rebate_settings.store');
