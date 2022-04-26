<?php

use Illuminate\Support\Facades\Route;

Route::get('user_logs', [App\Http\Controllers\Api\Admin\UserLogController::class, 'index'])->name('user_logs.index');
Route::get('user_logs/{user_log}', [App\Http\Controllers\Api\Admin\UserLogController::class, 'show'])->name('user_logs.show');
