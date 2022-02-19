<?php

namespace Tests\Feature\Http\Controllers\Api\Admin;

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

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        Client::factory()->count(3)->create();

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

    /**
     * @test
     */
    public function store_saves()
    {
        $code = $this->faker->word;
        $percentage_share = $this->faker->randomFloat(/** decimal_attributes **/);
        $created_by = User::factory()->create();
        $updated_by = User::factory()->create();

        $response = $this->post(route('clients.store'), [
            'code' => $code,
            'percentage_share' => $percentage_share,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $clients = Client::query()
            ->where('code', $code)
            ->where('percentage_share', $percentage_share)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $clients);
        $client = $clients->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $client = Client::factory()->create();

        $response = $this->get(route('clients.show', $client));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\Admin\ClientController::class,
            'update',
            \App\Http\Requests\Api\Admin\ClientUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $client = Client::factory()->create();
        $code = $this->faker->word;
        $percentage_share = $this->faker->randomFloat(/** decimal_attributes **/);
        $created_by = User::factory()->create();
        $updated_by = User::factory()->create();

        $response = $this->put(route('clients.update', $client), [
            'code' => $code,
            'percentage_share' => $percentage_share,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $client->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($code, $client->code);
        $this->assertEquals($percentage_share, $client->percentage_share);
        $this->assertEquals($created_by->id, $client->created_by_id);
        $this->assertEquals($updated_by->id, $client->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $client = Client::factory()->create();

        $response = $this->delete(route('clients.destroy', $client));

        $response->assertNoContent();

        $this->assertDeleted($client);
    }
}
