<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ResourceController;
use App\Http\Controllers\Traits\SetActiveStatus;
use App\Http\Queries\PageContentQuery;
use App\Http\Requests\Api\Admin\PageContentRequest;
use App\Http\UserLogAttributes\PageContentUserLog;
use App\Models\PageContent;
use Illuminate\Http\Request;

class PageContentController extends ResourceController
{
    use SetActiveStatus;

    public function __construct()
    {
        $this->hook(function () {
            $this->model = PageContent::class;
            $this->crudUserLog = new PageContentUserLog;
        });

        $this->hook(function () {
            $this->query = new PageContentQuery;
        })->only(['index', 'show']);

        $this->hook(function () {
            $this->request = PageContentRequest::class;
        })->only(['store', 'update']);

        $this->setUpCrudUserLog();
    }

    protected function resolveRecord(Request $request)
    {
        return $this->getRecord($request->route('page_content'));
    }
}
