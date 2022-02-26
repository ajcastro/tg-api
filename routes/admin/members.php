<?php

use Illuminate\Support\Facades\Route;

Route::post('members/kick_all', [App\Http\Controllers\Api\Admin\MemberController::class, 'kickAll'])->name('members.kick_all');
Route::post('members/{member}/kick', [App\Http\Controllers\Api\Admin\MemberController::class, 'kick'])->name('members.kick');
Route::post('members/{member}/suspend', [App\Http\Controllers\Api\Admin\MemberController::class, 'suspend'])->name('members.suspend');
Route::delete('members/{member}/suspend', [App\Http\Controllers\Api\Admin\MemberController::class, 'removeSuspension'])->name('members.remove_suspension');
Route::post('members/{member}/blacklist', [App\Http\Controllers\Api\Admin\MemberController::class, 'blacklist'])->name('members.blacklist');
Route::apiResource('members', App\Http\Controllers\Api\Admin\MemberController::class);
