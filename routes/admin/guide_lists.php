<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('guide_lists', App\Http\Controllers\Api\Admin\GuideListController::class);
Route::post('guide_lists/{guide_list}/set_active', [App\Http\Controllers\Api\Admin\GuideListController::class, 'setActiveStatus'])->name('guide_lists.set_active');
