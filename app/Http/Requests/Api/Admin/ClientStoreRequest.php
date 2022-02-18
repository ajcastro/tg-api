<?php

namespace App\Http\Requests\Api\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ClientStoreRequest extends FormRequest
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
        return [
            'code' => ['required', 'string', 'unique:clients,code'],
            'remarks' => ['string'],
            'percentage_share' => ['required', 'numeric', 'between:-99999999.99,99999999.99'],
            'created_by_id' => ['required', 'integer', 'exists:Users,id'],
            'updated_by_id' => ['required', 'integer', 'exists:Users,id'],
        ];
    }
}
