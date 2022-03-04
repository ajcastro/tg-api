<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\ParentGroup;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->seedDefaultClient();
        $this->seedDefaultParentGroup();
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->seedAdminUser();
        $this->seedDemoClientAndParentGroup();
        $this->seedDummyData();
    }

    private function seedDummyData()
    {
        if (app()->isProduction()) {return;}

        $this->call(DummySeeder::class);
    }

    private function seedDefaultClient()
    {
        Client::firstOrCreate([
            'id' => Client::DEFAULT_ID,
            'code' => Client::DEFAULT_CODE,
        ], [
            'remarks' => 'Default client',
            'is_active' => true,
        ]);
    }

    private function seedDefaultParentGroup()
    {
        ParentGroup::firstOrCreate([
            'id' => ParentGroup::DEFAULT_ID,
            'code' => ParentGroup::DEFAULT_CODE,
        ], [
            'client_id' => Client::DEFAULT_ID,
            'created_by_id' => User::ADMIN_ID,
            'updated_by_id' => User::ADMIN_ID,
        ]);
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

    private function seedDemoClientAndParentGroup()
    {
        $client = Client::firstOrCreate([
            'code' => 'demo',
        ], [
            'remarks' => 'demo client',
            'is_active' => true,
        ]);

        ParentGroup::firstOrCreate([
            'code' => 'demo',
        ], [
            'client_id' => $client->id,
            'created_by_id' => User::ADMIN_ID,
            'updated_by_id' => User::ADMIN_ID,
        ]);
    }
}
