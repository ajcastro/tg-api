<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('parent_groups', App\Http\Controllers\Api\Admin\ParentGroupController::class);
Route::post('parent_groups/{parent_group}/set_active', [App\Http\Controllers\Api\Admin\ParentGroupController::class, 'setActiveStatus'])->name('parent_groups.set_active');
