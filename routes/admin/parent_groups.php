<?php

use Illuminate\Support\Facades\Route;

Route::get('parent_groups/{parent_group}/users', [App\Http\Controllers\Api\Admin\ParentGroupController::class, 'users'])->name('parent_groups.users');
Route::get('parent_groups/{parent_group}/websites', [App\Http\Controllers\Api\Admin\ParentGroupController::class, 'websites'])->name('parent_groups.websites');
Route::post('parent_groups/{parent_group}/websites', [App\Http\Controllers\Api\Admin\ParentGroupController::class, 'addWebsite'])->name('parent_groups.add_website');
Route::delete('parent_groups/{parent_group}/websites/{website}', [App\Http\Controllers\Api\Admin\ParentGroupController::class, 'removeWebsite'])->name('parent_groups.remove_website');
Route::apiResource('parent_groups', App\Http\Controllers\Api\Admin\ParentGroupController::class);
Route::post('parent_groups/{parent_group}/set_active', [App\Http\Controllers\Api\Admin\ParentGroupController::class, 'setActiveStatus'])->name('parent_groups.set_active');
