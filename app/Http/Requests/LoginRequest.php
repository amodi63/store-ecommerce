<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LoginRequest extends FormRequest
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
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'يجب ادخال البريد الالكتروني',
            'email.string' => 'يجب أن يكون البريد الالكتروني نص',
            'email.email' => 'يجب ادخال البريد الالكتروني',
            'password.required' => 'يجب ادخال كلمة المرور',

        ];
    }

}
