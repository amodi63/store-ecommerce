<?php

namespace App\Http\Requests;

use App\Rules\ProductAttribute;
use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100', new ProductAttribute($this->name, $this->id)],
        ];
        
    }
    public function messages()
    {
        return [
            'name.required' => __('validation/validation.required'),
            'name.string' => __('validation/validation.string'),

        ];

    }
}
