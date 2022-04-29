<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\PromotionSettingRequest;
use App\Models\Promotion;
use App\Models\PromotionSetting;
use App\Models\UserLog;
use Illuminate\Http\Request;

class PromotionSettingController extends Controller
{
    public function __construct()
    {
        $this->hook(function ($request) {
            $record = $request->route('promotion');

            UserLog::fromRequest($request)
                ->fill([
                    'category' => 'PROMO',
                    'activity' => 'View Promotion Settings',
                    'detail' => "{$record->id}, {$record->title}"
                ])
                ->save();
        })->only(['show']);

        $this->hook(function ($request) {
            $record = $request->route('promotion');

            UserLog::fromRequest($request)
                ->fill([
                    'category' => 'PROMO',
                    'activity' => 'Update Promotion Settings',
                    'detail' => "{$record->id}, {$record->title}"
                ])
                ->save();
        })->only(['store']);
    }

    public function show(Promotion $promotion)
    {
        $setting = $promotion->setting;

        $setting->deposit_methods = $promotion->bankGroups()->pluck('bank_groups.id')->all();
        $setting->game_list = $promotion->games()->pluck('menus.id')->all();

        return $setting;
    }

    public function store(Promotion $promotion, PromotionSettingRequest $request)
    {
        /** @var PromotionSetting */
        $setting = $promotion->setting;
        $setting->fill($request->validated());
        $setting->save();

        $promotion->bankGroups()->sync($request->deposit_methods);
        $promotion->games()->sync($request->game_list);
    }
}
