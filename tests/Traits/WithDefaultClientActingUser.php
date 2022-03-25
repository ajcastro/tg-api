<?php

namespace Tests\Traits;

use App\Models\Client;
use App\Models\User;
use Database\Seeders\DefaultClientSeeder;
use Laravel\Sanctum\Sanctum;

/** @mixin \Tests\TestCase */
trait WithDefaultClientActingUser
{
    public function setUpDefaultClientActingUser()
    {
        $this->seed(DefaultClientSeeder::class);

        /** @var Client */
        $client = Client::find(Client::DEFAULT_ID);

        $user = $client->getSuperAdmin();

        /** @var ParentGroup */
        $parentGroup = $client->parentGroups()->first();

        Sanctum::actingAs($user);

        /** @var Mockery\MockInterface */
        $token = $user->currentAccessToken();
        $token->shouldReceive('getParentGroup')->andReturn($parentGroup);
        $token->shouldReceive('getRole')->andReturn($parentGroup->role);
    }
}
