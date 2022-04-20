<?php

namespace Database\Seeders;

use App\Models\ContactSetting;
use App\Models\Website;
use Illuminate\Database\Seeder;

class ContactSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (
            app()->environment('production') ||
            ContactSetting::query()->count() > 0
        ) {
            return;
        }

        $websites = Website::get();

        foreach ($websites as $website) {
            ContactSetting::factory(10)->create([
                'website_id' => $website->id,
            ]);
        }
    }
}
