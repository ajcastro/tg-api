<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ResourceController;
use App\Http\Controllers\Traits\SetActiveStatus;
use App\Http\Queries\MarketWebsiteQuery;
use App\Http\Requests\Api\Admin\MarketWebsiteRequest;
use App\Models\MarketWebsite;

class MarketWebsiteController extends ResourceController
{
    use SetActiveStatus;

    public function __construct()
    {
        $this->hook(function () {
            $this->model = MarketWebsite::class;
        });

        $this->hook(function () {
            $this->query = new MarketWebsiteQuery;
        })->only(['index', 'show']);

        $this->hook(function () {
            $this->request = MarketWebsiteRequest::class;
        })->only(['update']);
    }
}
