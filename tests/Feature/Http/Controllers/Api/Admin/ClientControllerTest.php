<?php

namespace Tests\Feature\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Admin\ClientController;
use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\Admin\ClientController
 */
class ClientControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    protected $withActingUser = true;

    public function test_index_should_paginate_resource()
    {
        Client::withoutEvents(function () {
            Client::factory()->count(3)->create();
        });

        $response = $this->getJson(route('clients.index', ['include' => 'created_by,updated_by']));

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                [
                    ...Client::allowableFields(),
                    'created_by' => User::allowableFields(),
                    'updated_by' => User::allowableFields(),
                ]
            ]
        ]);
    }

    public function test_store_should_create()
    {
        $payload = [
            'code' => $this->faker->word,
            'percentage_share' => $this->faker->randomFloat(2),
            'remarks' => $this->faker->words(3, true),
        ];

        $response = $this->postJson(route('clients.store'), $payload);

        $this->assertDatabaseHas('clients', $payload);

        $response->assertCreated();
        $response->assertJsonStructure(['data' => Client::allowableFields()]);
    }


    public function test_update_should_update()
    {
        $payload = [
            'code' => $this->faker->word,
            'percentage_share' => $this->faker->randomFloat(2),
            'remarks' => $this->faker->words(3, true),
        ];
        $client = tap(Client::factory()->make())->saveQuietly();
        $response = $this->putJson(route('clients.update', $client), $payload);

        $this->assertDatabaseHas('clients', $payload);

        $response->assertSuccessful();
        $response->assertJsonStructure(['data' => Client::allowableFields()]);
    }

    public function test_destroy_should_delete()
    {
        $client = Client::factory()->create();

        $response = $this->delete(route('clients.destroy', $client));

        $response->assertNoContent();

        $this->assertDeleted($client);
    }
}
