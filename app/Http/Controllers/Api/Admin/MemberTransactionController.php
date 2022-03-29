<?php

namespace App\Http\Controllers\Api\Admin;

use App\Enums\MemberTransactionStatus;
use App\Events\DepositApproved;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResourceController;
use App\Http\Queries\MemberTransactionQuery;
use App\Http\Requests\Api\Admin\MemberTransactionRequest;
use App\Models\Member;
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
        $memberTransaction->member->incrementBalanceAmount($memberTransaction->credit_amount);

        event(new DepositApproved($memberTransaction));
    }

    public function enterRemarks(Request $request, MemberTransaction $memberTransaction)
    {
        $memberTransaction->remarks = $request->remarks;
        $memberTransaction->save();
    }

    public function cancel(Request $request, MemberTransaction $memberTransaction)
    {
        $request->validate([
            'id' => function ($attribute, $value, $fail) use ($memberTransaction) {
                if (!$memberTransaction->isDeposit()) {
                    $fail('Cancelation is for deposit only');
                }
            },
            'reason' => [
                'required',
            ],
        ]);

        $memberTransaction->status = MemberTransactionStatus::CANCELED;
        $memberTransaction->cancel_reason = $request->reason;
        $memberTransaction->save();

        /** @var Member */
        $member = $memberTransaction->member;
        $member->decrementBalanceAmount($memberTransaction->credit_amount);
        $member->decrementBalanceAmount($memberTransaction->memberPromotion->bonus_amount);
    }

    public function reject(Request $request, MemberTransaction $memberTransaction)
    {
        $request->validate([
            'id' => function ($attribute, $value, $fail) use ($memberTransaction) {
                if (!$memberTransaction->isWithdraw()) {
                    $fail('Reject is for withdraw only');
                }
            },
            'reason' => [
                'required',
            ],
        ]);

        $memberTransaction->reject($request->user(), $request->reason);
    }
}
