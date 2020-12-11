<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCommentRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'news_id' => 'required_without:post_id|exists:news,id',
            'post_id' => 'required_without:news_id|exists:posts,id',
            'comment' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|string'
        ];
    }
}
