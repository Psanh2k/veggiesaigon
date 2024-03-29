<?php

namespace App\Http\Requests\Posts;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'image'     => [
                'required',
                'image',
            ],
            'title'     => [
                'required',
                'min:3',  
            ],
            'content'     => [
                'required',
                'min:3',    
            ],
        ];
    }
}
