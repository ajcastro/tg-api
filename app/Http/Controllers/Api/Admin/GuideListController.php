<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ResourceController;
use App\Http\Controllers\Traits\SetActiveStatus;
use App\Http\Queries\GuideListQuery;
use App\Http\Requests\Api\Admin\GuideListRequest;
use App\Http\UserLogAttributes\GuideListUserLog;
use App\Models\GuideList;
use Illuminate\Http\Request;

class GuideListController extends ResourceController
{
    use SetActiveStatus;

    public function __construct()
    {
        $this->hook(function () {
            $this->model = GuideList::class;
            $this->crudUserLog = new GuideListUserLog;
        });

        $this->hook(function () {
            $this->query = new GuideListQuery;
        })->only(['index', 'show']);

        $this->hook(function () {
            $this->request = GuideListRequest::class;
        })->only(['store', 'update']);

        $this->setUpCrudUserLog();
    }

    protected function resolveRecord(Request $request)
    {
        return $this->getRecord($request->route('guide_list'));
    }
}
