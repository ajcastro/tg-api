<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Http\Controllers\Traits\FillResource
 * @mixin \App\Http\Controllers\Traits\SaveResource
 * @mixin \App\Http\Controllers\Traits\ResolvesModel
 * @mixin \App\Http\Controllers\Traits\ResolvesRequest
 */
trait UpdateResource
{
    public function update($id)
    {
        $request = $this->request();
        $model = $this->model()->resolveRouteBinding($id);

        $this->fill($model, $request);
        $this->save($model);

        return new JsonResource($model);
    }
}
