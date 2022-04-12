<?php

namespace App\Http\Requests\Api\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BankRequest extends FormRequest
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
        $bank = $this->route('bank');

        return sometimes_if($bank, [
            'bank_group_id' => [
                'required',
                'exists:bank_groups,id',
            ],
            'code' => [
                'required',
                'string',
                Rule::unique('banks', 'code')->ignore($bank),
            ],
            'name' => [
                'required',
            ],
            'website' => [
                'string',
            ],
            'logo' => [
                $bank ? ['nullable'] : ['required'],
                'file',
            ],
        ]);
    }
}
