<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Shop;


class FAQRequest extends FormRequest
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
            'title' => 'required|max:150|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'question' => 'required|max:150|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'answer' => 'required|max:150|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
        ];
    }
}
