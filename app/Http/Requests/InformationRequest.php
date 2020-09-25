<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class InformationRequest extends FormRequest
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
    public function rules(Request $request)
    {

        if ($request->job == 'دندان پزشک') {
            return [
                'job' => 'required',
                'meliPic' => 'required|mimes:jpeg,png,jpg,gif,PNG,JPEG',
                'nezamPic' => 'required|mimes:jpeg,png,jpg,gif,PNG,JPEG',
            ];
        } else if ($request->job == 'مرکز درمانی') {
            return [
                'job' => 'required',
                'javazPic' => 'required|mimes:jpeg,png,jpg,gif,PNG,JPEG'

            ];
        }

    }
}
