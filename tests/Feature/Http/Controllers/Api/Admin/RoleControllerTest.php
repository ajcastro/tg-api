<?php

namespace Tests\Feature\Http\Controllers\Api\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\Admin\RoleController
 */
class RoleControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    protected $withActingUser = true;

    public function test_index_should_paginate_resource()
    {
        Role::withoutEvents(function () {
            Role::factory()->count(3)->create();
        });

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
        $payload = Role::factory()->make()->toArray();

        $response = $this->postJson(route('roles.store'), $payload);

        $this->assertDatabaseHas('roles', $payload);

        $response->assertCreated();
        $response->assertJsonStructure(['data' => Role::allowableFields()]);
    }


    public function test_update_should_update()
    {
        $payload = Role::factory()->make()->toArray();
        $role = tap(Role::factory()->make())->saveQuietly();

        $response = $this->putJson(route('roles.update', $role), $payload);

        $response->assertSuccessful();
        $response->assertJsonStructure(['data' => Role::allowableFields()]);

        $this->assertDatabaseHas('roles', $payload);
    }

    public function test_destroy_should_delete()
    {
        $role = Role::factory()->create();

        $response = $this->delete(route('roles.destroy', $role));

        $response->assertNoContent();

        $this->assertDeleted($role);
    }

    public function test_set_active_should_set_active_true()
    {
        $role = Role::factory()->create(['is_active' => false]);

        $response = $this->postJson(route('roles.set_active', $role));
        $response->assertSuccessful();

        $this->assertTrue($role->refresh()->is_active);
    }

    public function test_set_active_should_set_active_false()
    {
        $role = Role::factory()->create(['is_active' => true]);

        $response = $this->postJson(route('roles.set_active', $role), ['is_active' => false]);
        $response->assertSuccessful();

        $this->assertFalse($role->refresh()->is_active);
    }
}
