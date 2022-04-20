<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('page_contents', App\Http\Controllers\Api\Admin\PageContentController::class);
