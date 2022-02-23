<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ResourceController;
use App\Http\Queries\ParentGroupQuery;
use App\Http\Requests\Api\Admin\ParentGroupRequest;
use App\Models\ParentGroup;

class ParentGroupController extends ResourceController
{
    public function __construct()
    {
        $this->hook(function () {
            $this->model = ParentGroup::class;
        });

        $this->hook(function () {
            $this->query = new ParentGroupQuery;
        })->only(['index', 'show']);

        $this->hook(function () {
            $this->request = ParentGroupRequest::class;
        })->only(['store', 'update']);
    }
}
