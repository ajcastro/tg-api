<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\PromotionSettingRequest;
use App\Models\Promotion;
use App\Models\PromotionSetting;
use App\Models\RebateSetting;
use Illuminate\Http\Request;

class RebateSettingController extends Controller
{
    public function index()
    {
        return RebateSetting::with('category')->get();
    }

    public function store(Request $request)
    {
        $inputs = collect($request->rebate_settings);

        $settings = RebateSetting::find($inputs->pluck('id'));

        foreach ($inputs as $input) {
            $setting = $settings->find($input['id']);
            $setting->fill($input);
            $setting->save();
        }
    }
}
