<?php

namespace App\Http\Controllers\Traits;

use App\Http\Queries\Contracts\QueryContract;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

trait PaginateOrListResource
{
    protected QueryContract $query;

    public function index(Request $request)
    {
        $query = $this->query->withAllDeclarations();

        $collection = $this->shouldPaginateResource($request)
            ? $query->paginate($request->per_page ?? $request->limit)
            : $query->get();

        return JsonResource::collection($collection);
    }

    protected function shouldPaginateResource(Request $request)
    {
        return $request->boolean('paginate', true);
    }
}
