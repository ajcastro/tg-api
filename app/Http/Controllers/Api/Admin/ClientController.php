<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\Traits\PaginateOrListResource;
use App\Http\Queries\ClientQuery;
use App\Http\Requests\Api\Admin\ClientRequest;
use App\Models\Client;

class ClientController extends ResourceController
{
    public function __construct()
    {
        $this->hook(function () {
            $this->model = Client::class;
        });

        $this->hook(function () {
            $this->query = new ClientQuery;
        })->only(['index', 'show']);

        $this->hook(function () {
            $this->request = ClientRequest::class;
        })->only(['store', 'update']);
    }
}
