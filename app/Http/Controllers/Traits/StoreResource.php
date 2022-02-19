<?php

namespace App\Http\Controllers\Traits;

use App\Http\Requests\Api\Admin\ClientRequest;
use Illuminate\Http\Resources\Json\JsonResource;

trait StoreResource
{
    public function store()
    {
        $request = $this->request();

        $instance = $this->model()->create($request->validated());

        return new JsonResource($instance);
    }
}
