<?php

namespace Database\Seeders;

use App\Models\GameCategory;
use App\Models\PageContent;
use App\Models\Permission;
use App\Models\ReferralLog;
use App\Models\ReferralLogDetail;
use App\Models\Website;
use Illuminate\Database\Seeder;

class OneTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PageContentsTableSeeder::class);
        $this->call(ContactSettingsTableSeeder::class);
    }
}
