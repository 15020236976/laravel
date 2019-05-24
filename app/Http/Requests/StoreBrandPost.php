<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandPost extends FormRequest
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
           'brand_name' => 'required|unique:brand1|max:50',
           'brand_price'=>'required',
           'brand_desc'=>'required',
           'brand_url'=>'required',
        ];
    }

    public function messages()
    {
        return [
        'brand_name.required'=>'名称不能为空',
        'brand_name.unique'=>'名称不能重复',
        'brand_name.max'=>'名称最大不能超过50',
        'brand_price.required'=>'价格不能为空',
        'brand_desc.required'=>'介绍不能为空',
        'brand_url.required'=>'网址不能为空',

         ];
    } 


}
