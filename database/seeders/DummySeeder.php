<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Member;
use App\Models\User;
use App\Models\Website;
use Illuminate\Database\Seeder;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (app()->isProduction()) {return;}

        Member::query()->truncate();
        Website::query()->truncate();
        Website::factory(2)
            ->has(Member::factory(10)->state([
                'suspended_by_id' => null,
                'blacklisted_by_id' => null,
            ]))
            ->create([
                'assigned_client_id' => Client::first()->id,
                'created_by_id' => User::ADMIN_ID,
                'updated_by_id' => User::ADMIN_ID,
            ]);

    }
}
