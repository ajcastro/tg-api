<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Resources\Json\JsonResource;

trait ShowResource
{
    public function show($id)
    {
        $instance = $this->model()->resolveRouteBinding($id);
        return new JsonResource($instance);
    }
}
