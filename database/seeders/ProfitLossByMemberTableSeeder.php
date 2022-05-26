<?php

namespace Database\Seeders;

use App\Models\GameCategory;
use App\Models\Permission;
use App\Models\ProfitLossByMember;
use App\Models\UserLog;
use App\Models\Website;
use Illuminate\Database\Seeder;

class ProfitLossByMemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (ProfitLossByMember::query()->count() > 0) {
            return;
        }

        $websites = Website::limit(5)->get();

        foreach ($websites as $website) {
            ProfitLossByMember::factory(10)->create([
                'website_id' => $website->id,
            ]);
        }
    }
}
