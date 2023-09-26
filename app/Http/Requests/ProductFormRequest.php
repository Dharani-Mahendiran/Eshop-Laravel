<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
            'cate_id' => ['required','integer'],
            'name' => ['required','string'],
            'slug' => ['required','string'],
            'description' => ['required'],
            'original_price' => ['required','string'],
            'selling_price' => ['required','string'],
            'image' => ['nullable','mimes:jpg,jpeg,png,svg'],
            'quantity' => ['required','string'],
            'meta_title' => ['required','string'],
            'meta_keyword' => ['required','string'],
            'meta_description' => ['required','string']
        ];
    }
}
