<?php

namespace App\Http\Requests\Api\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WebsiteRequest extends FormRequest
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
        $website = $this->route('website');

        return sometimes_if($website, [
            'assigned_client_id' => [
                'required',
                'exists:clients,id',
            ],
            'code' => [
                'required',
                'string',
                Rule::unique('websites', 'code')->ignore($website),
            ],
            'remarks' => [
                'nullable',
            ],
            'ip_address' => [
                'required',
                'ip',
            ],
            'domain_name' => [
                'required',
            ],
            'is_active' => [
                'boolean',
            ],
        ]);
    }
}
