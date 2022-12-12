<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->checkRole('create_posts');    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3|max:100',
            'info' => 'nullable|max:300',
            'branch_id' => 'required|numeric',
            'project_id' => 'required|numeric',
            'photo' => 'nullable|max:4000|file|mimes:png,jpg',
        ];
    }
}
