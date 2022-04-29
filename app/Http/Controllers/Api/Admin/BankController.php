<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ResourceController;
use App\Http\Controllers\Traits\SetActiveStatus;
use App\Http\Queries\BankQuery;
use App\Http\Requests\Api\Admin\BankRequest;
use App\Http\UserLogAttributes\BankUserLog;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends ResourceController
{
    use SetActiveStatus;

    public function __construct()
    {
        $this->hook(function () {
            $this->model = Bank::class;
            $this->crudUserLog = new BankUserLog;
        });

        $this->hook(function () {
            $this->query = new BankQuery;
        })->only(['index', 'show']);

        $this->hook(function () {
            $this->request = BankRequest::class;
        })->only(['store', 'update']);

        $this->setUpCrudUserLog();
    }

    protected function resolveRecord(Request $request)
    {
        return $this->getRecord($request->route('bank'));
    }
}
