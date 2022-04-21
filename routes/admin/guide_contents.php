<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('guide_contents', App\Http\Controllers\Api\Admin\GuideContentController::class)->except(['store']);
Route::post('guide_contents/{guide_list}/set_active', [App\Http\Controllers\Api\Admin\GuideContentController::class, 'setActiveStatus'])->name('guide_contents.set_active');
