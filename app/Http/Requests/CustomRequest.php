<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class CustomRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        if (request()->expectsJson()) {
            $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
           response()->json(
               [
                'success' => false , 'validate' => true,'data'=> $errors
               ],422
           )
        );
        }

        parent::failedValidation($validator);

    }
}
