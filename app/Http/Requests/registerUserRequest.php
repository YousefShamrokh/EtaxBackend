<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class registerUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required | string | max: 50',
            'email' => 'required | string | email | max: 50 | unique:users',
            'password' => 'required | string | min: 8'
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            'name.required' => 'Please Enter your Name',
            'name.max' => 'Name should be a maximum of 50 characters',

            'email.required' => 'Please Enter your Email',
            'email.email' => 'Input must be an email',
            'email.max' => 'Email should be a maximum of 50 characters',
            'email.unique' => 'This email is already in use',

            'password.required' => 'Please enter a password',
            'password.min' => 'Password should be a minimum of 8 characters'
        ];
    }
}