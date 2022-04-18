<?php

use Illuminate\Support\Facades\Route;

Route::get('referral_logs', [App\Http\Controllers\Api\Admin\ReferralLogController::class, 'index'])->name('referral_logs.index');

