<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
            'title' => 'required|max:100|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'description' => 'required|max:4000',
            // 'value.*' => 'nullable|max:4000|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'productCat_id' => 'bail|required|min:1|max:10000000000|regex:/^[0-9]+$/u',
            'priority' => 'nullable|min:1|max:10000000000|regex:/^[0-9]+$/u',
            'brand_id' => 'nullable|max:100000000|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            // 'color_amount' => 'sometimes',
            // 'color_amount_number.*' => 'required_with:color_amount,on',
            // 'specification_amount' => 'sometimes',
            // 'specification_amount_number.*' => 'required_with:specification_amount,on',
            // 'amount' => ['required',
            //     'regex:/^([0-9]+$)|^([۰-۹]+$)/','max:999999','min:0'
            // ],
            // 'min_amount' => ['required',
            //     'regex:/^([0-9]+$)|^([۰-۹]+$)/','max:999999','min:0'
            // ],
            'measure' => 'required|max:50|regex:/^[ا-یa-zA-Zء-ي., ]+$/u',
            'price' => ['required',
                'regex:/^([0-9]+$)|^([۰-۹]+$)/','max:9999999999999','min:0'
            ],
            // 'off_price' => ['nullable','lt:price',
            //     'regex:/^([0-9]+$)|^([۰-۹]+$)/','max:9999999999999','min:0'
            // ],
            'weight' => ['nullable',
                'regex:/^([0-9]+$)|^([۰-۹]+$)/','max:99999999','min:0'
            ],
            'aparat' => 'nullable',
            'shegeftangiz' => 'nullable',
            'userPrice' => 'nullable',
            'shortDescription' => 'required',
            'country_id' => 'nullable',
            'fast_sending' => 'in:on',
            // 'money_back' => 'in:on',
            // 'support' => 'in:on',
            // 'secure_payment' => 'in:on',
            // 'discount_status' => 'in:on',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
            // 'color.*' => 'nullable|max:1000|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'group.*.p_id' =>['required',
                'regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u','max:9999999999999','min:0',Rule::unique('specification_item_groups'),
            ],
            'group.*.amount' =>['required',
                'regex:/^([0-9]+$)|^([۰-۹]+$)/','max:9999999999999','min:0'
            ],
            'group.*.min_amount' =>['required',
                'regex:/^([0-9]+$)|^([۰-۹]+$)/','max:9999999999999','min:0'
            ],
            // 'group.*.items' => 'required',
            'group.*.items.*' => 'max:1000|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'tags' => 'nullable|max:500|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            // 'facility.*' => 'nullable|max:300|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,:() ]+$/u',
        ];
    }
}
