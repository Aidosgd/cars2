<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class OfferPostRequest extends Request
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
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'phone' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Укажите название',
            'description.required' => 'Укажите описание',
            'price.required' => 'Укажите цену',
            'phone.required' => 'Укажите телефон',
        ];
    }
}
