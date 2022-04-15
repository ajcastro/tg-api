<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Permission;
use App\Models\RebateSetting;
use App\Models\Role;
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
        $categories = Menu::onlyCategories()->get();

        foreach ($categories as $category) {
            $rebateSetting = RebateSetting::firstOrNew([
                'category_id' => $category->id,
            ]);
            $rebateSetting->save();
        }
    }
}
