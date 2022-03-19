<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            'Menu - Users Management' => require(__DIR__ . '/permissions/users.php'),
            'Menu - Members' => require(__DIR__ . '/permissions/members.php'),
            'Menu - Transactions' => require(__DIR__ . '/permissions/transactions.php'),
        ];

        foreach ($groups as $groupDisplay => $rows) {
            foreach ($rows as $row) {
                Permission::firstOrCreate([
                    'name' => $row['name'],
                ], $row + ['group_display' => $groupDisplay]);
            }
        }
    }
}
