<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserValidateRequest extends FormRequest
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
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users',
            'userlevel' => 'required|gte:1|lte:9',
        ];
    }
    public function messages()
    {
        return [
            'userlevel.required' => 'The user must have a category assigned',
            'userlevel.gte' => 'The user category is assigned with levels from 1 to 9',
            'userlevel.lte' => 'The user category is assigned with levels from 1 to 9',
        ];
    }
}
