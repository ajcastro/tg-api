<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\BankGroup;
use App\Models\Website;
use Illuminate\Database\Seeder;

class BanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (app()->environment('local', 'staging')) {
            Bank::truncate();
        }

        $banks = [
            [
                'code' => 'BCA',
                'name' => 'BCA',
                'bank_group_id' => BankGroup::BANK,
                'is_active' => 1,
            ],
            [
                'code' => 'BNI',
                'name' => 'BNI',
                'bank_group_id' => BankGroup::BANK,
                'is_active' => 1,
            ],
            [
                'code' => 'BRI',
                'name' => 'BRI',
                'bank_group_id' => BankGroup::BANK,
                'is_active' => 1,
            ],
            [
                'code' => 'MANDIRI',
                'name' => 'MANDIRI',
                'bank_group_id' => BankGroup::BANK,
                'is_active' => 1,
            ],
            [
                'code' => 'CIMB',
                'name' => 'CIMB',
                'bank_group_id' => BankGroup::BANK,
                'is_active' => 1,
            ],
            [
                'code' => 'PERMATA',
                'name' => 'PERMATA',
                'bank_group_id' => BankGroup::BANK,
                'is_active' => 1,
            ],
            [
                'code' => 'SAKUKU',
                'name' => 'SAKUKU',
                'bank_group_id' => BankGroup::EPAYMENT,
                'is_active' => 1,
            ],
            [
                'code' => 'GOPAY',
                'name' => 'GOPAY',
                'bank_group_id' => BankGroup::EPAYMENT,
                'is_active' => 1,
            ],
            [
                'code' => 'LinkAJA',
                'name' => 'LinkAJA',
                'bank_group_id' => BankGroup::EPAYMENT,
                'is_active' => 1,
            ],
            [
                'code' => 'DANA',
                'name' => 'DANA',
                'bank_group_id' => BankGroup::EPAYMENT,
                'is_active' => 1,
            ],
            [
                'code' => 'OVO',
                'name' => 'OVO',
                'bank_group_id' => BankGroup::EPAYMENT,
                'is_active' => 1,
            ],
            [
                'code' => 'JENIUS',
                'name' => 'JENIUS',
                'bank_group_id' => BankGroup::EPAYMENT,
                'is_active' => 1,
            ],
        ];

        foreach ($banks as $bank) {
            Bank::firstOrCreate(['code' => $bank['code']], $bank);
            Bank::firstOrCreate(['name' => $bank['code']], $bank);
        }
    }
}
