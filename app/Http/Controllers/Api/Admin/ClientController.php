<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\PaginateOrListResource;
use App\Http\Queries\Client\ClientQuery;
use App\Http\Requests\Api\Admin\ClientStoreRequest;
use App\Http\Requests\Api\Admin\ClientUpdateRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientController extends Controller
{
    use PaginateOrListResource;

    public function __construct()
    {
        $this->hook(function () {
            $this->query = new ClientQuery;
        })->only('index');
    }

    public function show(Request $request, Client $client)
    {
        return new JsonResource($client);
    }

    public function store(ClientStoreRequest $request)
    {
        $client = Client::create($request->validated());

        return new JsonResource($client);
    }

    public function update(ClientUpdateRequest $request, Client $client)
    {
        $client->update($request->validated());

        return new JsonResource($client);
    }

    public function destroy(Request $request, Client $client)
    {
        $client->delete();

        return response()->noContent();
    }
}
