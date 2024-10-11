<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('create product');
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'release_date' => 'required|date',
            'product_image' => 'nullable|image|max:2048',
            'company_id' => 'required|exists:company,id', 
        ];
    }

}