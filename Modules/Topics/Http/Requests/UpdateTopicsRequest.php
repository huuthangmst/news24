<?php

namespace Modules\Topics\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTopicsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

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
            'name' => 'bail|required|max:255|min:3',
            'category_id'=> 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name cannot be blank',
            'name.max' => 'Name cannot exceed 255 characters',
            'name.min' => 'Name cannot be less than 3 characters',
            'category_id'=>"Categories cannot be blank"
        ];
    }
}
