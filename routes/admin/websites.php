<?php

use App\Http\Controllers\Api\Admin\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::apiResource('websites', App\Http\Controllers\Api\Admin\WebsiteController::class);
Route::post('websites/{website}/set_active', [App\Http\Controllers\Api\Admin\WebsiteController::class, 'setActiveStatus'])->name('websites.set_active');
