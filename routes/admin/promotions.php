<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('promotions', App\Http\Controllers\Api\Admin\PromotionController::class);
Route::post('promotions/{promotion}/set_active', [App\Http\Controllers\Api\Admin\PromotionController::class, 'setActiveStatus'])->name('promotions.set_active');
Route::get('promotions/{promotion}/settings', [App\Http\Controllers\Api\Admin\PromotionSettingController::class, 'show'])->name('promotions.settings.show');
Route::post('promotions/{promotion}/settings', [App\Http\Controllers\Api\Admin\PromotionSettingController::class, 'store'])->name('promotions.settings.store');
