<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralProductRequest extends FormRequest
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
            'short_description' => ['nullable', 'string'],
            'description' => ['required', 'string', 'max:1000'],
            'slug' => ['required', 'unique:products,slug'],
            'is_active' => ['boolean'],
            'categories' => ['required','array', 'min:1'],
            'categories.*' => ['numeric', 'exists:categories,id'],
            'tags' => ['nullable'],
            'brand_id' => ['required']  
            


        ];
    }
    public function messages()
    {
        return [
            'name.required' => __('validation/validation.required'),
            'name.string' => __('validation/validation.string'),
            'slug.required' => __('validation/validation.required'),
            'slug.unique' => __('validation/validation.unique'),

        ];
    }
}
