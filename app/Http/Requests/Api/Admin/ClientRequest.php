<?php

namespace App\Http\Requests\Api\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
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
        $client = $this->route('client');

        return sometimes_if($client, [
            'code' => [
                'required',
                'string',
                Rule::unique('clients', 'code')->ignore($client),
            ],
            'percentage_share' => [
                'required',
                'numeric',
            ],
            'remarks' => [
                'nullable',
            ],
        ]);
    }
}
