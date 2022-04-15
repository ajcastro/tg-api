<?php

namespace Database\Seeders;

use App\Models\GameCategory;
use App\Models\Menu;
use App\Models\Permission;
use App\Models\RebateSetting;
use App\Models\Role;
use App\Models\Website;
use Illuminate\Database\Seeder;

class RebateSettingsSeeder extends Seeder
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

        $menus = Menu::onlyCategories()->get();
        $gameCategories = $menus->map(fn ($menu) => GameCategory::firstOrCreate(['title' => $menu->title]));

        $websites = Website::get();
        foreach ($websites as $website) {
            /** @var Website $website */
            $rebate = $website->rebate;
            $rebate->save();

            foreach ($gameCategories as $gameCategory) {
                $rebate->settings()->firstOrCreate([
                    'rebate_id' => $rebate->id,
                    'game_category_id' => $gameCategory->id,
                ]);
            }
        }
    }
}
