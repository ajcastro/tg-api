<?php

namespace Tests\Feature\Http\Controllers\Api\Admin;

use App\Models\Website;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\Admin\WebsiteController
 */
class WebsiteControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    protected $withActingUser = true;

    public function test_index_should_paginate_resource()
    {
        Website::withoutEvents(function () {
            Website::factory()->count(3)->create();
        });

        $response = $this->getJson(route('websites.index', ['include' => 'created_by,updated_by']));

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                [
                    ...Website::allowableFields(),
                    'created_by' => User::allowableFields(),
                    'updated_by' => User::allowableFields(),
                ]
            ]
        ]);
    }

    public function test_store_should_create()
    {
        $payload = Website::factory()->make()->only(['code', 'ip_address', 'domain_name', 'remarks']);

        $response = $this->postJson(route('websites.store'), $payload);

        $this->assertDatabaseHas('websites', $payload);

        $response->assertCreated();
        $response->assertJsonStructure(['data' => Website::allowableFields()]);
    }


    public function test_update_should_update()
    {
        $payload = Website::factory()->make()->only(['code', 'ip_address', 'domain_name', 'remarks']);

        $website = tap(Website::factory()->make())->saveQuietly();
        $response = $this->putJson(route('websites.update', $website), $payload);

        $this->assertDatabaseHas('websites', $payload);

        $response->assertSuccessful();
        $response->assertJsonStructure(['data' => Website::allowableFields()]);
    }

    public function test_destroy_should_delete()
    {
        $website = Website::factory()->create();

        $response = $this->delete(route('websites.destroy', $website));

        $response->assertNoContent();

        $this->assertDeleted($website);
    }

    public function test_set_active_should_set_active_true()
    {
        $website = Website::factory()->create(['is_active' => false]);
        $response = $this->postJson(route('websites.set_active', $website));

        $response->assertSuccessful();

        $this->assertTrue($website->refresh()->is_active);
    }

    public function test_set_active_should_set_active_false()
    {
        $website = Website::factory()->create(['is_active' => true]);

        $response = $this->postJson(route('websites.set_active', $website), ['is_active' => false]);
        $response->assertSuccessful();

        $this->assertFalse($website->refresh()->is_active);
    }
}
