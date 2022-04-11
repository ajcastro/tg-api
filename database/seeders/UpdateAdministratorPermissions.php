<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class UpdateAdministratorPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (app()->environment('local', 'staging', 'testing')) {
            Permission::truncate();
        }

        $this->call(PermissionsTableSeeder::class);
        $roles = Role::where('name', 'Administrator')->get();

        $roles->each->assignAllPermissions();
    }
}
