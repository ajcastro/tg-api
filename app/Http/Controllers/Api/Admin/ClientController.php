<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\PaginateOrListResource;
use App\Http\Queries\Client\ClientQuery;
use App\Http\Requests\Api\Admin\ClientRequest;
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

    public function store(ClientRequest $request)
    {
        $client = Client::create($request->validated());

        return new JsonResource($client);
    }

    public function update(ClientRequest $request, Client $client)
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
