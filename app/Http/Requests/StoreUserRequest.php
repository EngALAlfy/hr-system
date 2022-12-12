<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->checkRole('create_users');
     }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:100|unique:users,name',
            'email' => 'required|min:3|max:100|unique:users,email|email',
            'project_id' => 'required|numeric',
            'salary' => 'required|numeric',
            'password' => 'required|min:5|max:20',
            'job_title' => 'required|min:3|max:100',
            'photo' => 'nullable|max:4000|file|mimes:png,jpg',
            'roles' => 'required|array',
        ];
    }
}
