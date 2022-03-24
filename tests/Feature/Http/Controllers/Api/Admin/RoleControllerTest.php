<?php

namespace Tests\Feature\Http\Controllers\Api\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;
use Tests\Traits\WithDefaultClientActingUser;

/**
 * @see \App\Http\Controllers\Api\Admin\RoleController
 */
class RoleControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker, WithDefaultClientActingUser;

    public function test_index_should_paginate_resource()
    {
        /** @var User */
        $user = auth()->user();

        Role::factory()->count(3)->create([
            'parent_group_id' => $user->getCurrentAccessToken()->getParentGroup()->id,
        ]);

        $response = $this->getJson(route('roles.index', []));

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                [
                    ...Role::allowableFields(),
                ]
            ]
        ]);
    }

    public function test_store_should_create()
    {
        /** @var User */
        $user = auth()->user();
        $payload = [
            'parent_group_id' => $user->getCurrentAccessToken()->getParentGroup()->id,
            'name' => 'Writer',
        ];

        $response = $this->postJson(route('roles.store'), $payload);

        $response->assertCreated();
        $this->assertDatabaseHas('roles', $payload);

        $response->assertCreated();
        $response->assertJsonStructure(['data' => Role::allowableFields()]);
    }


    public function test_update_should_update()
    {
        /** @var User */
        $user = auth()->user();
        $payload = [
            'parent_group_id' => $user->getCurrentAccessToken()->getParentGroup()->id,
            'name' => 'Writer',
        ];

        $role = Role::factory()->create(['name' => 'Moderator']+$payload);

        $response = $this->putJson(route('roles.update', $role), $payload);

        $response->assertSuccessful();
        $response->assertJsonStructure(['data' => Role::allowableFields()]);

        $this->assertDatabaseHas('roles', $payload);
    }

    public function test_destroy_should_delete()
    {
        /** @var User */
        $user = auth()->user();
        $role = Role::factory()->create([
            'parent_group_id' => $user->getCurrentAccessToken()->getParentGroup()->id,
            'name' => 'Writer',
        ]);

        $response = $this->delete(route('roles.destroy', $role));

        $response->assertNoContent();

        $this->assertDeleted($role);
    }

    public function test_set_active_should_set_active_true()
    {
        /** @var User */
        $user = auth()->user();
        $role = Role::factory()->create([
            'parent_group_id' => $user->getCurrentAccessToken()->getParentGroup()->id,
            'name' => 'Writer',
            'is_active' => false
        ]);

        $response = $this->postJson(route('roles.set_active', $role));
        $response->assertSuccessful();

        $this->assertTrue($role->refresh()->is_active);
    }

    public function test_set_active_should_set_active_false()
    {
        /** @var User */
        $user = auth()->user();
        $role = Role::factory()->create([
            'parent_group_id' => $user->getCurrentAccessToken()->getParentGroup()->id,
            'name' => 'Writer',
            'is_active' => true
        ]);

        $response = $this->postJson(route('roles.set_active', $role), ['is_active' => false]);
        $response->assertSuccessful();

        $this->assertFalse($role->refresh()->is_active);
    }
}
