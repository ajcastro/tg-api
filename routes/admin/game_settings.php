<?php

use Illuminate\Support\Facades\Route;

Route::get('game_settings/{website}', [App\Http\Controllers\Api\Admin\GameSettingController::class, 'index'])->name('game_settings.index');
Route::post('game_settings/{website}', [App\Http\Controllers\Api\Admin\GameSettingController::class, 'store'])->name('game_settings.store');
