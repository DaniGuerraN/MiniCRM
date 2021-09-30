<?php

namespace App\Http\Requests\Employee;

use App\Http\Requests\FormRequest;


class EmployeeUpdateRequest extends FormRequest
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
            'first_name' => 'string|max:30',
            'last_name' => 'string|max:30',
            'company_id' => 'int',
            'email' => 'email|max:50|unique:employees',
            'phone_number' => 'string|max:30'
        ];
    }

    // public function messages()
    // {
    //     return [         
    //         'first_name.max' => 'A first name is too long',
    //         'first_name.string' => 'A first name must be a string',
         
    //         'last_name.max' => 'A last name is too long',
    //         'last_name.string' => 'A last name must be a string',
            
    //         'company_id.string' => 'A company id must be a int',
           
    //         'email.max' => 'A email is too long',
    //         'email.email' => 'A email must be a valid email',
    //         'email.unique' => 'This email already registered',
          
    //         'phone_number.max' => 'A phone number is too long',
    //         'phone_number.string' => 'A phone number must be a string',
    //     ];
    // }

}
