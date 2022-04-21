<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ResourceController;
use App\Http\Controllers\Traits\SetActiveStatus;
use App\Http\Queries\GuideListQuery;
use App\Http\Requests\Api\Admin\GuideListRequest;
use App\Models\GuideList;

class GuideListController extends ResourceController
{
    use SetActiveStatus;

    public function __construct()
    {
        $this->hook(function () {
            $this->model = GuideList::class;
        });

        $this->hook(function () {
            $this->query = new GuideListQuery;
        })->only(['index', 'show']);

        $this->hook(function () {
            $this->request = GuideListRequest::class;
        })->only(['store', 'update']);
    }
}
