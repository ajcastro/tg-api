<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\PromotionSettingRequest;
use App\Models\ReferralSetting;
use App\Models\UserLog;
use App\Models\Website;
use Illuminate\Http\Request;

class WebsiteSettingController extends Controller
{

    public function __construct()
    {
        $this->hook(function ($request) {
            UserLog::fromRequest($request)
                ->fill([
                    'category' => 'CMS',
                    'activity' => 'View Website Settings',
                ])
                ->save();
        })->only(['index']);

        $this->hook(function ($request) {
            UserLog::fromRequest($request)
                ->fill([
                    'category' => 'CMS',
                    'activity' => 'Update Website Settings',
                ])
                ->save();
        })->only(['store']);
    }


    public function index(Website $website)
    {
        $setting = $website->setting;

        return $setting;
    }

    public function store(Request $request, Website $website)
    {
        $setting = $website->setting;

        $setting->fill($request->all());
        $setting->save();

        return $setting;
    }
}
