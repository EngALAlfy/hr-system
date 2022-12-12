<?php

namespace App\Http\Requests;

use App\Http\Requests\CustomRequest;
class LoginRequest extends CustomRequest
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

    public function rules()
    {
        return [
            'email' => ['required'],
            'password' => ['required'],
        ];
    }


    public function messages()
    {
        return [
            'email.required' => 'ادخل البريد',
            'password.required' => 'ادخل كلمة السر',
        ];
    }
}
