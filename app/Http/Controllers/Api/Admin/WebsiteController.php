<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ResourceController;
use App\Http\Controllers\Traits\SetActiveStatus;
use App\Http\Queries\WebsiteQuery;
use App\Http\Requests\Api\Admin\WebsiteRequest;
use App\Models\Website;

class WebsiteController extends ResourceController
{
    use SetActiveStatus;

    public function __construct()
    {
        $this->hook(function () {
            $this->model = Website::class;
        });

        $this->hook(function () {
            $this->query = new WebsiteQuery;
        })->only(['index', 'show']);

        $this->hook(function () {
            $this->request = WebsiteRequest::class;
        })->only(['store', 'update']);
    }
}
