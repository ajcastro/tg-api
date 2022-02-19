<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Resources\Json\JsonResource;

trait UpdateResource
{
    public function update($id)
    {
        $request = $this->request();
        $instance = $this->model()->resolveRouteBinding($id);
        $instance->update($request->validated());

        return new JsonResource($instance);
    }
}
