<?php

namespace Database\Seeders;

use App\Models\Market;
use Illuminate\Database\Seeder;

class MarketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Market::query()->count() > 0) {
            return;
        }

        $rows = [
            [
                'code' => 'TKY',
                'name' => 'Tokyo',
            ],
            [
                'code' => 'SOL',
                'name' => 'Seoul',
            ],
            [
                'code' => 'SGP',
                'name' => 'Singapore',
            ],
            [
                'code' => 'MNL',
                'name' => 'Manila',
            ],
            [
                'code' => 'BCL',
                'name' => 'Barcelona',
            ],
            [
                'code' => 'HK',
                'name' => 'HongKong',
            ],
            [
                'code' => 'BK',
                'name' => 'Bangkok',
            ],
            [
                'code' => 'MIL',
                'name' => 'Milan',
            ],
            [
                'code' => 'BEI',
                'name' => 'Beijing',
            ],
            [
                'code' => 'LGP',
                'name' => 'Legazpi',
            ],
        ];

        foreach ($rows as $row) {
            Market::firstOrCreate([
                'code' => $row['code']
            ], $row+['status' => collect(['online', 'offline'])->random()]);
        }
    }
}
