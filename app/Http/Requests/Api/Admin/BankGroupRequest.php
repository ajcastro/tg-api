<?php

namespace App\Http\Requests\Api\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BankGroupRequest extends FormRequest
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
        $bank_group = $this->route('bank_group');

        return sometimes_if($bank_group, [
            'code' => [
                'required',
                'string',
                Rule::unique('bank_groups', 'code')->ignore($bank_group),
            ],
            'is_require_account_no' => [
                'boolean',
            ],
        ]);
    }
}
