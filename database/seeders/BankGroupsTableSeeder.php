<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\BankGroup;
use Illuminate\Database\Seeder;

class BankGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'id' => BankGroup::BANK,
                'code' => 'BANK',
                'is_require_account_no' => 1,
            ],
            [
                'id' => BankGroup::EPAYMENT,
                'code' => 'ePayment',
                'is_require_account_no' => 0,
            ],
        ];

        foreach ($items as $item) {
            BankGroup::firstOrCreate([
                'id' => $item['id'],
            ], $item);
        }
    }
}
