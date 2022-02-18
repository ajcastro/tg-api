<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\ClientStoreRequest;
use App\Http\Requests\Api\Admin\ClientUpdateRequest;
use App\Http\Resources\Api\Admin\ClientCollection;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $collection = QueryBuilder::for(Client::class)
            ->allowedFilters([
                AllowedFilter::scope('search'),
            ])
            ->allowedFields([
                ...Client::tableColumns(),
                'created_by.id', 'created_by.name',
                'updated_by.id', 'updated_by.name',
            ])
            ->allowedIncludes([
                'created_by', 'updated_by',
            ])
            ->defaultSort('id')
            ->paginate();

        return JsonResource::collection($collection);
    }

    public function store(ClientStoreRequest $request)
    {
        $client = Client::create($request->validated());

        return new JsonResource($client);
    }

    public function show(Request $request, Client $client)
    {
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
