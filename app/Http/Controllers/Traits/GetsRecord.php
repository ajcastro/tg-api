<?php

namespace App\Http\Controllers\Traits;

trait GetsRecord
{
    public function getRecord($id)
    {
        // TODO: perform caching here that will be reset on every after http requests
        return $this->model()->resolveRouteBinding($id);
    }
}
