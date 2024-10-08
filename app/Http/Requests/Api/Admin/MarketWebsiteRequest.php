<?php

namespace App\Http\Requests\Api\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MarketWebsiteRequest extends FormRequest
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
        $market_website = $this->route('market_website');

        return sometimes_if($market_website, [
            'result_day' => [],
            'off_day' => [],
            'close_time' => [
                'required',
            ],
            'result_time' => [
                'required',
            ],
        ]);
    }
}
