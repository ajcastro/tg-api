<?php

use App\Http\Controllers\Api\Admin\ProfitLossByMemberController;
use Illuminate\Support\Facades\Route;

Route::get('profit_loss_by_members', [ProfitLossByMemberController::class, 'index'])->name('profit_loss_by_members.index');
