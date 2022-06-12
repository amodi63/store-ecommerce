<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'slug' => ['required', 'unique:tags,slug,' . $this->id],
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
