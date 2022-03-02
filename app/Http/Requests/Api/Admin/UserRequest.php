<?php

namespace App\Http\Requests\Api\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
        $user = $this->route('user');

        return sometimes_if($user, [
            'name' => [
                'required',
                'string',
            ],
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users', 'name')->ignore($user),
            ],
            'role_id' => [
                'required',
                'exists:roles,id',
            ],
            'password' => [
                $user ? [] : 'required',
                Password::min(8),
                'confirmed',
            ]
        ]);
    }
}
