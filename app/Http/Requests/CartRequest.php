<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
            'total_price' => 'numeric',
            'product_id' => 'min:1|max:100000|regex:/^[0-9]+$/u',
            'color' => 'nullable|min:1|max:100000|regex:/^[ا-یa-zA-Z0-9\-۰-۹ ]+$/u',
            'specification.*' => 'nullable|min:1|max:100000|regex:/^[ا-یa-zA-Z0-9\-۰-۹ ]+$/u',
        ];
    }
}
