<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\PromotionSettingRequest;
use App\Models\ReferralSetting;
use App\Models\Website;
use Illuminate\Http\Request;

class ReferralSettingController extends Controller
{
    public function index(Website $website)
    {
        $referral = $website->referral;
        $referral->load('settings.gameCategory');

        return $referral;
    }

    public function store(Request $request, Website $website)
    {
        $referral = $website->referral;

        $referral->fill($request->all());
        $referral->save();

        $inputs = collect($request->referral_settings);

        $settings = ReferralSetting::find($inputs->pluck('id'));

        foreach ($inputs as $input) {
            $setting = $settings->find($input['id']);
            $setting->fill($input);
            $setting->save();
        }
    }
}
