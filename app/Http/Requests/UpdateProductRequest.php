<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        $product = Product::find($this->route('id'));

        if (!$product) {
            return false; 
        }

        if (auth()->user()->hasRole('Administrator')) {
            return true;
        }

        return auth()->user()->hasRole('Manager') && auth()->user()->company_id === $product->company_id;
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'release_date' => 'nullable|date',
            'product_image' => 'nullable|image|max:2048',
            'company_id' => 'sometimes|required|exists:company,id', 
        ];
    }
}