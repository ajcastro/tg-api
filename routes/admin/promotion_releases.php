<?php

use Illuminate\Support\Facades\Route;

Route::get('promotion_releases', [App\Http\Controllers\Api\Admin\PromotionReleasesController::class, 'index'])->name('promotion_releases.index');
Route::post('promotion_releases/{member_promotion}/release', [App\Http\Controllers\Api\Admin\PromotionReleasesController::class, 'release'])->name('promotion_releases.release');
