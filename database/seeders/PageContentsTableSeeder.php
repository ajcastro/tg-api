<?php

namespace Database\Seeders;

use App\Models\PageContent;
use App\Models\Website;
use Illuminate\Database\Seeder;

class PageContentsTableSeeder extends Seeder
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
            PageContent::query()->count() > 0
        ) {
            return;
        }

        PageContent::truncate();

        $websites = Website::get();

        foreach ($websites as $website) {
            PageContent::factory(10)->create([
                'website_id' => $website->id,
            ]);
        }
    }
}
