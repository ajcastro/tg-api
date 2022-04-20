<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ResourceController;
use App\Http\Controllers\Traits\SetActiveStatus;
use App\Http\Queries\PageContentQuery;
use App\Http\Requests\Api\Admin\PageContentRequest;
use App\Models\PageContent;

class PageContentController extends ResourceController
{
    use SetActiveStatus;

    public function __construct()
    {
        $this->hook(function () {
            $this->model = PageContent::class;
        });

        $this->hook(function () {
            $this->query = new PageContentQuery;
        })->only(['index', 'show']);

        $this->hook(function () {
            $this->request = PageContentRequest::class;
        })->only(['store', 'update']);
    }
}
