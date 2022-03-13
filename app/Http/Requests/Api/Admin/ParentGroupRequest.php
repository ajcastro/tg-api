<?php

namespace App\Http\Requests\Api\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ParentGroupRequest extends FormRequest
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
        $parent_group = $this->route('parent_group');

        return sometimes_if($parent_group, [
            'code' => [
                'required',
                'string',
                Rule::unique('parent_groups', 'code')->ignore($parent_group),
            ],
            'remarks' => [
                'nullable',
            ],
        ]);
    }
}
