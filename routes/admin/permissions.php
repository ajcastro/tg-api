<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('permissions', App\Http\Controllers\Api\Admin\PermissionController::class)->except(['store', 'destroy']);
