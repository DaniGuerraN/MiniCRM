<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest as LaravelFormRequest;

abstract class FormRequest extends LaravelFormRequest
{
    use ApiResponser;
    
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            response()->json(['error' => $errors, 'success' => false], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}