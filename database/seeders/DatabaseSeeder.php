<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\ParentGroup;
use App\Models\Role;
use App\Models\User;
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
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->seedAdminUser();
        $this->seedDefaultClientAndParentGroup();
    }

    private function seedAdminUser()
    {
        User::firstOrCreate([
            'id' => User::ADMIN_ID,
            'parent_group_id' => ParentGroup::DEFAULT_ID,
            'username' => 'admin',
        ], [
            'role_id' => Role::ADMINISTRATOR_ID,
            'email' => 'admin@demo.com',
            'name' => 'Admin User',
            'password' => bcrypt('password'),
        ]);
    }

    private function seedDefaultClientAndParentGroup()
    {
        Client::firstOrCreate([
            'id' => Client::DEFAULT_ID,
            'code' => Client::DEFAULT_CODE,
        ], [
            'remarks' => 'Default client',
            'is_active' => true,
            'is_hidden' => true,
        ]);
    }
}
