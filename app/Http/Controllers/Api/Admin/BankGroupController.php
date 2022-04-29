<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ResourceController;
use App\Http\Controllers\Traits\SetActiveStatus;
use App\Http\Queries\BankGroupQuery;
use App\Http\Requests\Api\Admin\BankGroupRequest;
use App\Http\UserLogAttributes\BankGroupUserLog;
use App\Models\BankGroup;
use Illuminate\Http\Request;

class BankGroupController extends ResourceController
{
    use SetActiveStatus;

    public function __construct()
    {
        $this->hook(function () {
            $this->model = BankGroup::class;
            $this->crudUserLog = new BankGroupUserLog;
        });

        $this->hook(function () {
            $this->query = new BankGroupQuery;
        })->only(['index', 'show']);

        $this->hook(function () {
            $this->request = BankGroupRequest::class;
        })->only(['store', 'update']);

        $this->setUpCrudUserLog();
    }

    protected function resolveRecord(Request $request)
    {
        return $this->getRecord($request->route('bank'));
    }
}
