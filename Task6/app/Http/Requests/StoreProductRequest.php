<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name_en' => 'required|string|max:100',
            'name_ar' => 'required|string|max:100',
            'price' => 'required|numeric|min:1|max:99999.99',
            'quantity' => 'nullable|integer|max:9999',
            'status' => 'required|integer|min:0|max:1',
            'subcategory_id' => 'required|string|exists:subcategories,id',
            'brand_id' => 'nullable|string|exists:brands,id',
            'desc_ar' => 'required|string|max:522',
            'desc_en' => 'required|string|max:522',
            'image' => 'required|max:1000|mimes:jpg,png,jpeg'
        ];
    }
}
