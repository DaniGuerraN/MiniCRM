<?php

namespace App\Http\Requests\Company;

use App\Http\Requests\FormRequest;

class CompanyUpdateRequest extends FormRequest
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
            'name' => 'string|max:150',
            'email' => 'email|max:50',
            'image' => 'image|dimensions:min_width=100,min_height=100',
            'web_site' => 'string'
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'name.max' => 'A name is too long',
    //         'name.string' => 'A name must be a string',

    //         'email.max' => 'A email is too long',
    //         'email.email' => 'A email must be a valid email',
    //         'email.unique' => 'This email already registered',
            
    //         'image.image' => 'The image file must be an image',
    //         'image.dimensions' => 'A image must be 100 x 100',

    //         'web_site.string' => 'A web must be a string',
    //     ];
    // }


}
