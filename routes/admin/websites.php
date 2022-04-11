<?php

use App\Http\Controllers\Api\Admin\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::post('websites/{website}/update_credit', [App\Http\Controllers\Api\Admin\WebsiteController::class, 'updateCredit'])->name('websites.update_credit');
Route::get('websites/{website}/credit', [App\Http\Controllers\Api\Admin\WebsiteController::class, 'getCredit'])->name('websites.get_credit');
Route::post('websites/{website}/set_active', [App\Http\Controllers\Api\Admin\WebsiteController::class, 'setActiveStatus'])->name('websites.set_active');
Route::apiResource('websites', App\Http\Controllers\Api\Admin\WebsiteController::class);
