<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('game_categories', App\Http\Controllers\Api\Admin\GameCategoryController::class)->only(['index', 'show']);
