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

        $items = [
            [
                'title' => '+12025550185',
                'value' => 'https://api.whatsapp.com/send?phone=+12025550185',
            ],
            [
                'title' => 'Facebook',
                'value' => 'https://www.facebook.com/TeleGaming',
            ],
            [
                'title' => 'Twitter',
                'value' => 'https://twitter.com/TeleGaming',
            ],
            [
                'title' => 'Instagram',
                'value' => 'https://www.instagram.com/TeleGaming',
            ],
            [
                'title' => 'Google',
                'value' => 'https://www.google.com/?q=TeleGaming',
            ],
            [
                'title' => 'Youtube',
                'value' => 'https://www.youtube.com/?q=TeleGaming',
            ],
            [
                'title' => 'TeleGaming',
                'value' => 'https://t.me/TeleGaming',
            ],
        ];

        foreach ($websites as $website) {
            foreach ($items as $item) {
                ContactSetting::factory()->create([
                    'website_id' => $website->id,
                    'is_active' => 1,
                    'is_shown' => 1,
                ] + $item);
            }
        }
    }
}
