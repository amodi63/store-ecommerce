<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeOptionsRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'attribute_id' => ['required', 'exists:attributes,id'],
            'product_id' => ['required', 'exists:products,id'],
            'price' => ['required', 'numeric'],
            'attribute_id.*' => ['numeric'],
        ];
    }
}
