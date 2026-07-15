<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class createBookRequest extends FormRequest
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
            'publisher_name' => 'required | string | max: 50',
            'publish_date' => 'required | string | date_format:d-m-Y',
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            'name.required' => 'Please Enter the name of the book',
            'name.max' => 'Name should be a maximum of 50 characters',

            'publisher_name.required' => 'Please Enter your Email',
            'publisher_name.max' => 'Email should be a maximum of 50 characters',
            
            'publish_date.required' => 'Please enter a date',
            'publish_date.date_format' => 'Date should be in the D-M-Y format'
        ];
    }
}
