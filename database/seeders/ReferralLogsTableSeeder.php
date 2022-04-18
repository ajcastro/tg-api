<?php

namespace Database\Seeders;

use App\Models\GameCategory;
use App\Models\Permission;
use App\Models\ReferralLog;
use App\Models\ReferralLogDetail;
use App\Models\Website;
use Illuminate\Database\Seeder;

class ReferralLogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (app()->environment('production')) {
            return;
        }

        $websites = Website::get();
        $gameCategories = GameCategory::get();

        foreach ($websites as $website) {
            foreach ($gameCategories as $gameCategory) {
                /** @var ReferralLog */
                $referralLog = ReferralLog::factory()->create([
                    'website_id' => $website->id,
                ]);

                $details = $referralLog->details()->saveMany(ReferralLogDetail::factory(3)->make([
                    'game_category_id' => $gameCategory->id,
                ]));

                $referralLog->referral_amount = collect($details)->sum('referral_amount');
                $referralLog->save();
            }
        }
    }
}
