<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'email' => ['required', 'email', 'unique:admins,email,' . $this->id],
            'password' => ['required', 'confirmed', 'min:6'],
            'password_confirmation' => ['required', 'min:6'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => __('validation/validation.required'),
            'name.string' => __('validation/validation.string'),
            'email.required' => __('validation/validation.required'),
            'email.email' => __('validation/validation.email'),
            'email.email' => __('validation/validation.unique'),
            'password.required' => __('validation/validation.required'),
            'password.confirmed' => __('validation/validation.confirmed'),
            'password.min' => __('validation/validation.min_pass'),
            'password_confirmation' => __('validation/validation.required'),
            'password_confirmation' => __('validation/validation.password_confirmation'),
        ];
    }
}
