<?php

namespace App\Http\Requests\Api\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MemberTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $member_transaction = $this->route('member_transaction');

        return sometimes_if($member_transaction, [
            'type' => [
                'required',
                'in:deposit,withdraw',
            ],
            'website_id' => [
                'required',
                'exists:websites,id'
            ],
            'member_id' => [
                'required',
                'exists:members,id'
            ],
            'is_adjustment' => [
                'required',
                'in:1', // only adjustments are created in admin
            ],
            'company_bank' => [
                'required',
            ],
            'company_bank_factor' => [
                'required',
                'numeric',
            ],
            'amount' => [
                'required',
                'numeric',
            ],
            'remarks' => [],
        ]);
    }
}
