<?php

namespace App\Http\Requests\Api\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
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
        $role = $this->route('role');

        return sometimes_if($role, [
            'parent_group_id' => [
                'required',
                'exists:parent_groups,id'
            ],
            'name' => [
                'required',
                'string',
                Rule::unique('roles', 'name')->ignore($role)->where(function ($query) {
                    $query->where('parent_group_id', $this->parent_group_id);
                }),
            ],
        ]);
    }
}
