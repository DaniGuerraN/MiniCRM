<?php

namespace App\Http\Requests\Employee;

use App\Http\Requests\FormRequest;

class EmployeeStoreRequest extends FormRequest
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
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:30',
            'company_id' => 'required|int',
            'email' => 'required|email|max:50|unique:employees',
            'phone_number' => 'required|string|max:30'
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'first_name.required' => 'A first name is required',            
    //         'first_name.max' => 'A first name is too long',
    //         'first_name.string' => 'A first name must be a string',

    //         'last_name.required' => 'A last name is required',            
    //         'last_name.max' => 'A last name is too long',
    //         'last_name.string' => 'A last name must be a string',

    //         'company_id.required' => 'A company id is required',            
    //         'company_id.string' => 'A company id must be a int',

    //         'email.required' => 'A email is required',            
    //         'email.max' => 'A email is too long',
    //         'email.email' => 'A email must be a valid email',
    //         'email.unique' => 'This email already registered',

    //         'phone_number.required' => 'A phone number is required',            
    //         'phone_number.max' => 'A phone number is too long',
    //         'phone_number.string' => 'A phone number must be a string',
    //     ];
    // }


}
