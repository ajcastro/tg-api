<?php

namespace App\Http\Requests\Api\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PromotionSettingRequest extends FormRequest
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
            'valid_from' => [
                'required',
                'date',
            ],
            'valid_thru' => [
                $this->no_valid_thru_date ? 'nullable' :'required',
                'date',
            ],
            'given_method' => [
                'required',
            ],
            'is_for_new_member_only' => [
                'required',
            ],
            'promotion_type' => [
                'required',
            ],
            'allowed_n_times' => [
                'required',
                'numeric',
            ],
            'calculation_type' => [
                'required',
            ],
            'calculation_fix_amount' => [
                'required',
                'numeric',
            ],
            'calculation_rate' => [
                'required',
                'numeric',
            ],
            'turn_over_obligation' => [
                'required',
                'numeric',
            ],
            'is_include_bonus_to_calculate_obligation' => [
                'required',
            ],
            'min_deposit' => [
                'required',
                'numeric',
            ],
            'max_given_count' => [
                'required',
                'numeric',
            ],
            'max_given_amount' => [
                'required',
                'numeric',
            ],
            'is_auto_release' => [
                'required',
            ],
            'is_lock_withdrawal' => [
                'required',
            ],
            'is_shown_in_banner' => [
                'required',
            ],
            'deposit_methods' => [
                'required',
            ],
            'game_list' => [
                'required',
            ],
        ];
    }
}
