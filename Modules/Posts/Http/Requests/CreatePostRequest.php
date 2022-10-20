<?php

namespace Modules\Posts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
            'title' => 'bail|required|unique:posts|min:3',
            'description' => 'required|min:3',
            'content' => 'required',
            'user_id' => 'required',
            'topic_id' => 'required',
            //'enable' => 'required',
        ];
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
            'user_id.required' => 'User_id cannot be blank',
            // 'enable.required' => 'Enable cannot be blank',
        ];
    }
}
