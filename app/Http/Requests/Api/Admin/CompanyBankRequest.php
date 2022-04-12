<?php

namespace App\Http\Requests\Api\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyBankRequest extends FormRequest
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
        $company_bank = $this->route('company_bank');

        return sometimes_if($company_bank, [
            'website_id' => [
                'required',
            ],
            'bank_type' => [
                'required',
                Rule::in(['withdraw', 'deposit']),
            ],
            'bank_code' => [
                'required',
                'string',
            ],
            'bank_acc_name' => [
                'required',
                'string',
            ],
            'bank_acc_no' => [
                'required',
                'string',
            ],
            'is_auto_update_balance' => [
                'boolean',
            ],
            'bank_factor' => [
                'required',
                'numeric',
            ],
            'min_amount' => [
                Rule::requiredIf($this->bank_type === 'deposit'),
                'numeric',
            ],
            'max_amount' => [
                Rule::requiredIf($this->bank_type === 'withdraw'),
                'numeric',
            ],
        ]);
    }
}
