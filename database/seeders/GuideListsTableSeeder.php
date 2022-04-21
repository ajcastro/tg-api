<?php

namespace Database\Seeders;

use App\Models\GuideList;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class GuideListsTableSeeder extends Seeder
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
            GuideList::query()->count() > 0
        ) {
            return;
        }

        GuideList::factory(10)->create();
    }
}
