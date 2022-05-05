<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\PromotionSettingRequest;
use App\Models\Game;
use App\Models\Market;
use App\Models\MarketLimitSetting;
use App\Models\ReferralSetting;
use App\Models\UserLog;
use App\Models\Website;
use Illuminate\Http\Request;

class GameSettingController extends Controller
{
    public function __construct()
    {
        $this->hook(function ($request) {
            UserLog::fromRequest($request)
                ->fill([
                    'category' => '4D Setting',
                    'activity' => 'View Game Settings',
                ])
                ->save();
        })->only(['index']);

        $this->hook(function ($request) {
            UserLog::fromRequest($request)
                ->fill([
                    'category' => '4D Setting',
                    'activity' => 'Update Game Settings',
                ])
                ->save();
        })->only(['store']);
    }

    private function queryGames(Website $website)
    {
        return Game::query()
            ->with([
                'setting' => function ($query) use ($website) {
                    $query->where('website_id', $website->id);
                },
            ]);
    }

    public function index(Website $website)
    {
        return $this->queryGames($website)->get();
    }

    public function store(Request $request, Website $website)
    {
        $request->validate([
            'game_settings' => ['array'],
        ]);

        $items = $request->collect('game_settings');
        $games = $this->queryGames($website)->find($items->pluck('game_id'));

        foreach ($games as $game) {
            $item = $items->where('game_id', $game->id)->first() ?? [];
            $game->setting->fill(['website_id' => $website->id] + $item)->save();
        }
    }
}
