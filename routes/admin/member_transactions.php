<?php

use App\Http\Controllers\Api\Admin\MemberTransactionController;
use Illuminate\Support\Facades\Route;

Route::post('member_transactions/{member_transaction}/approve', [MemberTransactionController::class, 'approve'])->name('member_transactions.approve');
Route::post('member_transactions/{member_transaction}/reject', [MemberTransactionController::class, 'reject'])->name('member_transactions.reject');
Route::post('member_transactions/{member_transaction}/cancel', [MemberTransactionController::class, 'cancel'])->name('member_transactions.cancel');
Route::post('member_transactions/{member_transaction}/enter_remarks', [MemberTransactionController::class, 'enterRemarks'])->name('member_transactions.enter_remarks');
Route::post('member_transactions/{member_transaction}/change_status', [MemberTransactionController::class, 'changeStatus'])->name('member_transactions.change_status');
Route::apiResource('member_transactions', MemberTransactionController::class)->except(['destroy']);
