<?php

namespace Database\Seeders;

use App\Models\ParentGroup;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
            [
                'id' => 1,
                'name' => 'Administrator',
            ], [
                'id' => 2,
                'name' => 'Moderator',
            ],
        ];

        foreach ($rows as $row) {
            Role::firstOrCreate([
                'parent_group_id' => ParentGroup::DEFAULT_ID,
                'id' => $row['id']
            ], $row);
        }
    }
}
