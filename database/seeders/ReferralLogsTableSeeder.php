<?php

namespace Database\Seeders;

use App\Models\GameCategory;
use App\Models\Permission;
use App\Models\ReferralLog;
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
                ReferralLog::factory()->create([
                    'website_id' => $website->id,
                    'game_category_id' => $gameCategory->id,
                ]);
            }
        }
    }
}
