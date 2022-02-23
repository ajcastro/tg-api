<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('parent_groups', App\Http\Controllers\Api\Admin\ParentGroupController::class);
