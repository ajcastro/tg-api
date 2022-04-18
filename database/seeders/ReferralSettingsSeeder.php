<?php

namespace Database\Seeders;

use App\Models\GameCategory;
use App\Models\Menu;
use App\Models\Permission;
use App\Models\RebateSetting;
use App\Models\Role;
use App\Models\Website;
use Illuminate\Database\Seeder;

class ReferralSettingsSeeder extends Seeder
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

        $gameCategories = GameCategory::get();

        $websites = Website::get();
        foreach ($websites as $website) {
            /** @var Website $website */
            $referral = $website->referral;
            $referral->save();

            foreach ($gameCategories as $gameCategory) {
                $referral->settings()->firstOrCreate([
                    'referral_id' => $referral->id,
                    'game_category_id' => $gameCategory->id,
                ]);
            }
        }
    }
}
