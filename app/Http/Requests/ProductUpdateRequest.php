<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ProductUpdateRequest extends FormRequest
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
            'productCat_id' => 'bail|required|min:1|max:10000000000|regex:/^[0-9]+$/u',
            'brand_id' => 'nullable|max:100000000|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'description' => 'required|min:10|max:4000',
            'measure' => 'required|max:50|regex:/^[ا-یa-zA-Zء-ي., ]+$/u',
            'price' => ['required',
                'regex:/^([0-9]+$)|^([۰-۹]+$)/','max:9999999999999','min:0'
            ],
            'weight' => ['nullable',
                'regex:/^([0-9]+$)|^([۰-۹]+$)/','max:99999999','min:0'
            ],
            'aparat' => 'nullable',
            'shegeftangiz' => 'nullable',
            'userPrice' => 'nullable',
            'group.*.p_id' =>['required',
            'regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u','max:9999999999999','min:0',
        ],
        'group.*.amount' =>['required',
            'regex:/^([0-9]+$)|^([۰-۹]+$)/','max:9999999999999','min:0'
        ],
        'group.*.min_amount' =>['required',
            'regex:/^([0-9]+$)|^([۰-۹]+$)/','max:9999999999999','min:0'
        ],
        // 'group.*.items' => 'required',
        'group.*.items.*' => 'max:1000|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'shortDescription' => 'required',
            'country_id' => 'nullable',
            'specifications.*' => 'nullable|max:400|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'tags' => 'nullable|max:500|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'image' => 'mimes:jpeg,png,jpg,gif|max:4048',
        ];
    }
}
