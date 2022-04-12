<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('bank_groups', App\Http\Controllers\Api\Admin\BankGroupController::class);
