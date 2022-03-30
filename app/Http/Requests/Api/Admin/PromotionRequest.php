<?php

namespace App\Http\Requests\Api\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PromotionRequest extends FormRequest
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
        $promotion = $this->route('promotion');

        return sometimes_if($promotion, [
            'website_id' => [
                'required',
                'exists:websites,id'
            ],
            'title' => [
                'required',
                'string',
            ],
            'short_description' => [
                'required',
                'string',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'slug' => [
                'required',
                'string',
                Rule::unique('promotions', 'slug')->ignore($promotion),
            ],
            'sort_order' => [
                'required',
                'numeric',
            ],
            'image' => [
                $promotion ? ['nullable'] : ['required'],
                'file',
            ]
        ]);
    }
}
