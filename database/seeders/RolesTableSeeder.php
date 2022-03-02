<?php

namespace Database\Seeders;

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
                'id' => $row['id']
            ], $row);
        }
    }
}
