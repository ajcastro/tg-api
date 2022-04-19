<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\PromotionSettingRequest;
use App\Models\ReferralSetting;
use App\Models\Website;
use Illuminate\Http\Request;

class WebsiteSettingController extends Controller
{
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
