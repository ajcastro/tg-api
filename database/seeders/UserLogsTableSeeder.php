<?php

namespace Database\Seeders;

use App\Models\GameCategory;
use App\Models\Permission;
use App\Models\UserLog;
use App\Models\Website;
use Illuminate\Database\Seeder;

class UserLogsTableSeeder extends Seeder
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

        $websites = Website::limit(5)->get();

        foreach ($websites as $website) {
            UserLog::factory(10)->create([
                'website_id' => $website->id,
            ]);
        }
    }
}
