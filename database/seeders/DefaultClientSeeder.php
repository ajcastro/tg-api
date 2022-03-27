<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use App\Models\Website;
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
        /** @var Client */
        $client = Client::firstOrCreate([
            'id' => Client::DEFAULT_ID,
            'code' => Client::DEFAULT_CODE,
        ], [
            'remarks' => 'Default client',
            'is_active' => true,
            'is_hidden' => true,
        ]);

        $this->seedDefaultWebsite($client);
    }

    public function seedDefaultWebsite($client)
    {
        Website::firstOrCreate([
            'assigned_client_id' => $client->id,
            'code' => 'tg',
        ], [
            'ip_address' => '127.0.0.1',
            'domain_name' => 'telegaming.net',
            'is_active' => true,
            'created_by_id' => User::ADMIN_ID,
            'updated_by_id' => User::ADMIN_ID,
        ]);
    }
}
