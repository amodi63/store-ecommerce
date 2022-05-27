<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'value' => ['required', 'string'],
            'plain_value' => ['required', 'numeric', 'min:1'],
        ];

    }
    public function messages()
    {
        return [
            'value.required' => __('validation/validation.required'),
            'value.string' => __('validation/validation.string'),
            'plain_value.required' => __('validation/validation.required'),
            'plain_value.numeric' => __('validation/validation.numeric'),
            'plain_value.min' => __('validation/validation.min'),

        ];
    }
}
