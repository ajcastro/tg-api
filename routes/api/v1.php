<?php

use App\Http\Controllers\Api\V1\GameSettingController;
use Illuminate\Support\Facades\Route;

Route::apiResource('game_settings', GameSettingController::class)->only(['index', 'show']);
