<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

/** @see Client::createDefauParentGroupAndAdministratorUser() */
class DefaultClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
