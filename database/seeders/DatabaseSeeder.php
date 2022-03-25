<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\ParentGroup;
use App\Models\Role;
use App\Models\User;
use finfo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsTableSeeder::class);
        $this->call(DefaultClientSeeder::class);
    }
}
