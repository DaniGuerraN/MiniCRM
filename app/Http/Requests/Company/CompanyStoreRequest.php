<?php

namespace App\Http\Requests\Company;

use App\Http\Requests\FormRequest;

class CompanyStoreRequest extends FormRequest
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
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:50|unique:companies',
            'image' => 'required|image|dimensions:min_width=100,min_height=100',
            'web_site' => 'required|string',
            'notification_email' => 'email|max:50',
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
    //         'email.email' => 'A email must be a valid email',
    //         'email.unique' => 'This email already registered',

    //         'image.required' => 'A image is required',            
    //         'image.image' => 'The image file must be an image',
    //         'image.dimensions' => 'A image must be 100 x 100',
            
    //         'web_site.required' => 'A web site is required',
    //         'web_site.string' => 'A web must be a string',

    //         'notification_email.max' => 'A email is too long',
    //         'notification_email.email' => 'A email must be a valid email',
    //     ];
    // }



}
