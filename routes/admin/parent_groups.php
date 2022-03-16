<?php

use Illuminate\Support\Facades\Route;

Route::get('parent_groups/{parent_group}/users', [App\Http\Controllers\Api\Admin\ParentGroupController::class, 'users'])->name('parent_groups.users');
Route::apiResource('parent_groups', App\Http\Controllers\Api\Admin\ParentGroupController::class);
Route::post('parent_groups/{parent_group}/set_active', [App\Http\Controllers\Api\Admin\ParentGroupController::class, 'setActiveStatus'])->name('parent_groups.set_active');
