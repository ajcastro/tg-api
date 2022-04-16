<?php

use Illuminate\Support\Facades\Route;

Route::get('rebate_logs', [App\Http\Controllers\Api\Admin\RebateLogController::class, 'index'])->name('rebate_logs.index');

