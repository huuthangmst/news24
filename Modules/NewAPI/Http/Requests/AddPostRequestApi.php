<?php

namespace Modules\NewAPI\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddPostRequestApi extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'bail|required|unique:posts|min:3',
            'description' => 'bail|required|min:3',
            'content' => 'required',
            'topic_id' => 'required',
            'feature_image_path' => 'required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'title.required' => 'Title cannot be blank',
            'title.unique' => 'Title already exists',
            'title.min' => 'Title cannot be less than 3 characters',
            'description.required' => 'Description cannot be blank',
            'description.min' => 'Description cannot be less than 3 characters',
            'content.required' => 'Content cannot be blank',
            'feature_image_path.required' => 'feature_image_path cannot be blank',
        ];
    }
}
