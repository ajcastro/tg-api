<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\PromotionSettingRequest;
use App\Models\Market;
use App\Models\MarketLimitSetting;
use App\Models\ReferralSetting;
use App\Models\UserLog;
use App\Models\Website;
use Illuminate\Http\Request;

class MarketLimitSettingController extends Controller
{
    public function __construct()
    {
        $this->hook(function ($request) {
            UserLog::fromRequest($request)
                ->fill([
                    'category' => '4D Setting',
                    'activity' => 'View Market Limit Setting',
                ])
                ->save();
        })->only(['index']);

        $this->hook(function ($request) {
            UserLog::fromRequest($request)
                ->fill([
                    'category' => '4D Setting',
                    'activity' => 'Update Market Limit Settings',
                ])
                ->save();
        })->only(['store']);
    }

    private function queryMarkets(Website $website)
    {
        return Market::query()
            ->with([
                'limitSetting' => function ($query) use ($website) {
                    $query->where('website_id', $website->id);
                },
            ]);
    }

    public function index(Website $website)
    {
        return $this->queryMarkets($website)->get();
    }

    public function store(Request $request, Website $website)
    {
        $request->validate([
            'market_limit_settings' => ['array'],
        ]);

        $items = $request->collect('market_limit_settings');
        $markets = $this->queryMarkets($website)->find($items->pluck('market_id'));

        foreach ($markets as $market) {
            $item = $items->where('market_id', $market->id)->first() ?? [];
            $market->limitSetting->fill(['website_id' => $website->id] + $item)->save();
        }
    }
}
