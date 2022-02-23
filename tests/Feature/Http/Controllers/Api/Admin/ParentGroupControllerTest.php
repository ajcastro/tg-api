<?php

namespace Tests\Feature\Http\Controllers\Api\Admin;

use App\Models\ParentGroup;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\Admin\ParentGroupController
 */
class ParentGroupControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    protected $withActingUser = true;

    public function test_index_should_paginate_resource()
    {
        ParentGroup::withoutEvents(function () {
            ParentGroup::factory()->count(3)->create();
        });

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
        $payload = ParentGroup::factory()->make()->only(['client_id', 'code', 'remarks']);

        $response = $this->postJson(route('parent_groups.store'), $payload);

        $response->assertCreated();
        $response->assertJsonStructure(['data' => ParentGroup::allowableFields()]);

        $this->assertDatabaseHas('parent_groups', $payload);
    }


    public function test_update_should_update()
    {
        $payload = ParentGroup::factory()->make()->only(['client_id', 'code', 'remarks']);

        $parentGroup = tap(ParentGroup::factory()->make())->saveQuietly();
        $response = $this->putJson(route('parent_groups.update', $parentGroup), $payload);

        $this->assertDatabaseHas('parent_groups', $payload);

        $response->assertSuccessful();
        $response->assertJsonStructure(['data' => ParentGroup::allowableFields()]);
    }

    public function test_destroy_should_delete()
    {
        $parentGroup = ParentGroup::factory()->create();

        $response = $this->delete(route('parent_groups.destroy', $parentGroup));

        $response->assertNoContent();

        $this->assertDeleted($parentGroup);
    }
}
