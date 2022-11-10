<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'bail|required|max:255|min:3',
            'email' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name cannot be blank',
            'name.max' => 'Name cannot exceed 255 characters',
            'name.min' => 'Name cannot be less than 3 characters',
            'email.required' => 'Email cannot be blank',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
