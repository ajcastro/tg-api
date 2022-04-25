<?php

use Illuminate\Support\Facades\Route;

Route::get('transfer_logs', [App\Http\Controllers\Api\Admin\TransferLogController::class, 'index'])->name('transfer_logs.index');
Route::get('transfer_logs/{transfer_log}', [App\Http\Controllers\Api\Admin\TransferLogController::class, 'show'])->name('transfer_logs.show');
