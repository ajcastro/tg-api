<?php

namespace App\Http\Controllers\Api\Admin;

use App\Enums\MemberTransactionStatus;
use App\Events\DepositApproved;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResourceController;
use App\Http\Queries\MemberTransactionQuery;
use App\Http\Requests\Api\Admin\MemberTransactionRequest;
use App\Models\CompanyBank;
use App\Models\Member;
use App\Models\MemberTransaction;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

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
        if ($memberTransaction->isWithdraw()) {
            return $this->approveWithdraw($request, $memberTransaction);
        }

        return $this->approveDeposit($request, $memberTransaction);
    }

    protected function approveDeposit(Request $request, MemberTransaction $memberTransaction)
    {
        /** @var Website */
        $website = $memberTransaction->website;

        if ($website->getCredit() === 0) {
            throw ValidationException::withMessages(['id' => [
                'Balance is not enough.'
            ]]);
        }

        $memberTransaction->approve($request->user());
        $memberTransaction->member->incrementBalanceAmount($memberTransaction->credit_amount);

        event(new DepositApproved($memberTransaction));
    }

    protected function approveWithdraw(Request $request, MemberTransaction $memberTransaction)
    {
        $request->validate([
            'company_bank_id' => [
                'required',
                'exists:company_banks,id',
            ],
        ]);

        /** @var CompanyBank */
        $companyBank = CompanyBank::find($request->company_bank_id);
        $memberTransaction->company_bank = $companyBank->bank_code;

        $memberTransaction->approve($request->user());
        $memberTransaction->member->decrementBalanceAmount($memberTransaction->amount);
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
        $member->decrementBalanceAmount($memberTransaction->memberPromotion->bonus_amount ?? 0);
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

    public function changeStatus(MemberTransaction $memberTransaction, Request $request)
    {
        $request->validate([
            'status' => [
                'required',
                Rule::in([
                    MemberTransactionStatus::PENDING,
                    MemberTransactionStatus::IN_PROGRESS,
                ]),
            ]
        ]);

        $memberTransaction->status = $request->status;
        $memberTransaction->save();
    }
}
