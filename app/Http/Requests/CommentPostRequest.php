<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CommentPostRequest extends Request
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
            'name' => 'required',
            'email' => 'required|email',
            'text' => 'required', 
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Укажите имя',
            'email.required' => 'Укажите email',
            'email.email' => 'Укажите email корректно',
            'text.required' => 'Укажите сообщение',
        ];
    }
}
