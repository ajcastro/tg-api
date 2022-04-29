<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\PromotionSettingRequest;
use App\Models\RebateSetting;
use App\Models\UserLog;
use App\Models\Website;
use Illuminate\Http\Request;

class RebateSettingController extends Controller
{
    public function __construct()
    {
        $this->hook(function ($request) {
            UserLog::fromRequest($request)
                ->fill([
                    'category' => 'REBATE',
                    'activity' => 'View Rebate Settings',
                ])
                ->save();
        })->only(['index']);

        $this->hook(function ($request) {
            UserLog::fromRequest($request)
                ->fill([
                    'category' => 'REBATE',
                    'activity' => 'Update Rebate Settings',
                ])
                ->save();
        })->only(['store']);
    }

    public function index(Website $website)
    {
        $rebate = $website->rebate;
        $rebate->load('settings.gameCategory');

        return $rebate;
    }

    public function store(Request $request, Website $website)
    {
        $rebate = $website->rebate;

        $rebate->fill($request->all());
        $rebate->save();

        $inputs = collect($request->rebate_settings);

        $settings = RebateSetting::find($inputs->pluck('id'));

        foreach ($inputs as $input) {
            $setting = $settings->find($input['id']);
            $setting->fill($input);
            $setting->save();
        }
    }
}
