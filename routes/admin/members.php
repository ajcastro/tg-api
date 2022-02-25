<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('members', App\Http\Controllers\Api\Admin\MemberController::class);
