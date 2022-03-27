<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResourceController;
use App\Http\Queries\MemberTransactionQuery;
use App\Http\Requests\Api\Admin\MemberTransactionRequest;
use App\Models\MemberTransaction;
use Illuminate\Http\Request;

class MemberTransactionController extends ResourceController
{
    public function __construct()
    {
        $this->hook(function () {
            $this->model = MemberTransaction::class;
        });

        $this->hook(function () {
            $this->query = new MemberTransactionQuery;
        })->only(['index', 'show']);

        $this->hook(function () {
            $this->request = MemberTransactionRequest::class;
        })->only(['store']);
    }

    public function approve(Request $request, MemberTransaction $memberTransaction)
    {
        $memberTransaction->approve($request->user());
        $memberTransaction->member->incrementBalanceAmount($memberTransaction->amount);
    }

    public function reject(Request $request, MemberTransaction $memberTransaction)
    {
        $memberTransaction->reject($request->user());
    }

    public function enterRemarks(Request $request, MemberTransaction $memberTransaction)
    {
        $memberTransaction->remarks = $request->remarks;
        $memberTransaction->save();
    }
}
