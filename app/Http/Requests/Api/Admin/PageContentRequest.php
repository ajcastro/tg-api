<?php

namespace App\Http\Requests\Api\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageContentRequest extends FormRequest
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
            'short_description' => ['required'],
            'url' => ['required'],
            'is_shown' => ['boolean'],
            'meta_title' => [],
            'meta_keyword' => [],
            'meta_description' => [],
            'content' => [],
            'is_footer_displayed' => ['boolean'],
        ]);
    }
}
