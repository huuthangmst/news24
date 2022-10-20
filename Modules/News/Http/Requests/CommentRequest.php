<?php

namespace Modules\News\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'ranking' => 'bail|required',
            'comment'=>'bail|required|min:3'
        ];
    }
    public function messages()
    {
        return [
            'comment.required' => 'Name cannot be blank',
            'comment.min' => 'Comment cannot be less than 3 characters',
            'ranking.required' => 'Rating cannot be blank',
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
