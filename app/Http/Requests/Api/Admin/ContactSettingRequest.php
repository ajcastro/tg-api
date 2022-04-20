<?php

namespace App\Http\Requests\Api\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactSettingRequest extends FormRequest
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
        $contact_setting = $this->route('contact_setting');

        return sometimes_if($contact_setting, [
            'website_id' => ['required'],
            'title' => ['required'],
            'value' => ['required'],
            'status' => [],
            'is_shown' => ['boolean'],
        ]);
    }
}
