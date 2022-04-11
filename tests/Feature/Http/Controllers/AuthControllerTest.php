<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_auth_login_should_require_validation()
    {
        Client::create(['code' => 'spvadmin']);

        $response = $this->postJson('api/auth/login');

        $response->assertStatus(422);
    }

    public function test_auth_login_should_be_successful()
    {
        $client = Client::create(['code' => 'spvadmin']);
        $pg = $client->parentGroups->first();
        $user = $client->users->first();

        $response = $this->postJson('api/auth/login', [
            'parent_group_code' => $pg->code,
            'username' => $user->username,
            'password' => 'password'
        ]);

        $response->assertOk();
    }

    public function test_auth_me_should_return_user_info()
    {
        $client = Client::create(['code' => 'spvadmin']);
        $user = $client->users->first();

        Sanctum::actingAs($user);
        $response = $this->actingAs($user)->getJson('api/auth/me');

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'id', 'client_id',
                'username', 'name',
            ],
        ]);
    }
}
