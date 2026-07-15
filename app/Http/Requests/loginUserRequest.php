<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class loginUserRequest extends FormRequest
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
            'email' => 'required | string | email',
            'password' => 'required | string'
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            'email.required' => 'Please Enter your Email',
            'email.email' => 'Input must be an email',
            
            'password.required' => 'Please enter a password'
        ];
    }
}
