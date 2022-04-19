<?php

use Illuminate\Support\Facades\Route;

Route::get('website_settings/{website}', [App\Http\Controllers\Api\Admin\WebsiteSettingController::class, 'index'])->name('website_settings.index');
Route::post('website_settings/{website}', [App\Http\Controllers\Api\Admin\WebsiteSettingController::class, 'store'])->name('website_settings.store');
