<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPasswordValidateRequest extends FormRequest
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
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|same:password',
        ];
    }
    public function messages()
    {
        return [
            'password.required' => 'Please enter password',
            'password.min' => 'Password has to be at least 8 characters long',
            'password_confirmation.required' => 'Please confirm password',
            'password_confirmation.same' => 'Passwords do not match',
        ];
    }
}