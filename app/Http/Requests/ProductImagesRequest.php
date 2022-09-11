<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductImagesRequest extends FormRequest
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
            'product_id' => ['required', 'exists:products,id'],
            'documents' => ['required', 'array'],
            'documents.*' => ['string'],
            
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
