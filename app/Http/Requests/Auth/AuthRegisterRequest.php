<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\FormRequest;

class AuthRegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'name.required' => 'A name is required',            
    //         'name.max' => 'A name is too long',
    //         'name.string' => 'A name must be a string',

    //         'email.required' => 'A email is required',            
    //         'email.max' => 'A email is too long',
    //         'email.string' => 'A email must be a string',
    //         'email.unique' => 'This email already registered',

    //         'password.required' => 'A password is required',            
    //         'password.min' => 'A password is too short',
    //         'password.string' => 'A password must be a string',
    //     ];
    // }



}
