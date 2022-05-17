<?php

use App\Models\Game;
use App\Models\GameSetting;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('game_setting', function (Request $request) {
    $request->validate([
        'website_code' => 'required',
        'game_code' => 'required',
    ]);

    $website = Website::where('code', $request->website_code)->firstOrFail();
    $game = Game::where('code', $request->game_code)->firstOrFail();

    return GameSetting::where(['website_id' => $website->id, 'game_id' => $game->id])->firstOrFail();
});
