<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ResourceController;
use App\Http\Controllers\Traits\SetActiveStatus;
use App\Http\Queries\BankQuery;
use App\Http\Requests\Api\Admin\BankRequest;
use App\Models\Bank;

class BankController extends ResourceController
{
    use SetActiveStatus;

    public function __construct()
    {
        $this->hook(function () {
            $this->model = Bank::class;
        });

        $this->hook(function () {
            $this->query = new BankQuery;
        })->only(['index', 'show']);

        $this->hook(function () {
            $this->request = BankRequest::class;
        })->only(['store', 'update']);
    }

    protected function fill($promotion, $request)
    {
        parent::fill($promotion, $request);

        /** @var UploadedFile */
        $uploadedFile = $request->file('logo');
        if ($uploadedFile) {
            $promotion->logo = $uploadedFile->store("banks/logos");
        }
    }
}
