<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ResourceController;
use App\Http\Controllers\Traits\SetActiveStatus;
use App\Http\Queries\CompanyBankQuery;
use App\Http\Requests\Api\Admin\CompanyBankRequest;
use App\Http\UserLogAttributes\CompanyBankUserLog;
use App\Models\CompanyBank;
use Illuminate\Http\Request;

class CompanyBankController extends ResourceController
{
    use SetActiveStatus;

    public function __construct()
    {
        $this->hook(function () {
            $this->model = CompanyBank::class;
            $this->crudUserLog = new CompanyBankUserLog;
        });

        $this->hook(function () {
            $this->query = new CompanyBankQuery;
        })->only(['index', 'show']);

        $this->hook(function () {
            $this->request = CompanyBankRequest::class;
        })->only(['store', 'update']);

        $this->setUpCrudUserLog();
    }

    protected function resolveRecord(Request $request)
    {
        return $this->getRecord($request->route('company_bank'));
    }
}
