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
        $rows = [
            ...require(__DIR__.'/permissions/users.php'),
            ...require(__DIR__.'/permissions/members.php'),
            ...require(__DIR__.'/permissions/transactions.php'),
        ];

        foreach ($rows as $row) {
            Permission::firstOrCreate([
                'name' => $row['name'],
            ], $row);
        }
    }
}

// special permission, i think for now are
// can view detail users,
// can activate member if suspend,
// can edit member password,
// can approve/reject deposit,
// can approve/reject withdraw
