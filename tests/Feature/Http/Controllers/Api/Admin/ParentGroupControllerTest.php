<?php

namespace Tests\Feature\Http\Controllers\Api\Admin;

use App\Models\Client;
use App\Models\ParentGroup;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;
use Tests\Traits\WithDefaultClientActingUser;

/**
 * @see \App\Http\Controllers\Api\Admin\ParentGroupController
 */
class ParentGroupControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker, WithDefaultClientActingUser;

    public function test_index_should_paginate_resource()
    {
        ParentGroup::factory()->count(3)->create(['client_id' => null]);

        $response = $this->getJson(route('parent_groups.index', ['include' => 'created_by,updated_by']));

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                [
                    ...ParentGroup::allowableFields(),
                    'created_by' => User::allowableFields(),
                    'updated_by' => User::allowableFields(),
                ]
            ]
        ]);
    }

    public function test_store_should_create()
    {
        $user = auth()->user();

        $payload = ParentGroup::factory()->make(['client_id' => null])->only(['code', 'remarks']);

        $response = $this->postJson(route('parent_groups.store'), $payload);

        $response->assertCreated();
        $response->assertJsonStructure(['data' => ParentGroup::allowableFields()]);

        $this->assertDatabaseHas('parent_groups', ['client_id' => $user->client_id] + $payload);
    }

    public function test_update_should_update()
    {
        $user = auth()->user();
        $payload = ParentGroup::factory()->make(['client_id' => null])->only(['code', 'remarks']);

        $parentGroup = ParentGroup::factory(['client_id' => null])->create();

        $response = $this->putJson(route('parent_groups.update', $parentGroup), $payload);

        $this->assertDatabaseHas('parent_groups', ['client_id' => $user->client_id]+$payload);

        $response->assertSuccessful();
        $response->assertJsonStructure(['data' => ParentGroup::allowableFields()]);
    }

    public function test_destroy_should_delete()
    {
        $parentGroup = ParentGroup::factory()->create(['client_id' => null]);

        $response = $this->delete(route('parent_groups.destroy', $parentGroup));

        $response->assertNoContent();

        $this->assertDeleted($parentGroup);
    }
}
