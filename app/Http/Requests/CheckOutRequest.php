<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckOutRequest extends FormRequest
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
            'address' => 'required|min:1|max:99999999|regex:/^[0-9-۰-۹]+$/u',
            'shipping_way' => 'in:quick_way,posting_way,person_way',
            'payment_method' => 'required|in:cash_payment,online_payment',
        ];
    }
}
