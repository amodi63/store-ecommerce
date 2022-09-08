<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductPriceRequest extends FormRequest
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
            'price' => ['required', 'numeric'],
            'special_price' => ['nullable','numeric'],
            'special_price_type' => ['required_with:special_price', Rule::in(['fixed', 'present'])],
            'special_price_start' => ['required_with:special_price', 'date', 'date_format:Y-m-d'],
            'special_price_end' => ['required_with:special_price', 'date', 'date_format:Y-m-d'],
        ];
    
    }
    public function messages()
    {

        return [
            'price.required' => __('validation/validation.required'),
            'special_price.numeric' => __('validation/validation.string'),
           

        ];
    }

}
