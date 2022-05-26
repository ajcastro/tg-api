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
        // if (app()->environment('local', 'testing')) {
        //     Permission::truncate();
        // }

        $groups = [
            'General - Broadcast Messages' => require(__DIR__ . '/permissions/broadcast_messages.php'),
            'Menu - Dashboard' => require(__DIR__ . '/permissions/dashboard.php'),
            'Menu - Users Management' => require(__DIR__ . '/permissions/users.php'),
            'Menu - Members' => require(__DIR__ . '/permissions/members.php'),
            'Menu - Transactions' => require(__DIR__ . '/permissions/transactions.php'),
            'Menu - Promotions' => require(__DIR__ . '/permissions/promotions.php'),
            'Menu - Banking System' => require(__DIR__ . '/permissions/banking.php'),
            'Menu - CMS' => require(__DIR__ . '/permissions/cms.php'),
            'Menu - Report Logs' => require(__DIR__ . '/permissions/report_logs.php'),
            'Menu - 4D Setting' => require(__DIR__ . '/permissions/4d_settings.php'),
            'Menu - Reports' => require(__DIR__ . '/permissions/reports.php'),
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
