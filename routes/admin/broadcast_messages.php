<?php

use Illuminate\Support\Facades\Route;

Route::get('broadcast_messages', [App\Http\Controllers\Api\Admin\BroadcastMessageController::class, 'index'])->name('broadcast_messages.index');
Route::post('broadcast_messages', [App\Http\Controllers\Api\Admin\BroadcastMessageController::class, 'store'])->name('broadcast_messages.store');
