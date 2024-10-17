<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResourceRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('create resource');
    }

    public function rules()
    {
        return [
            'company_id' => 'required|exists:company,id',
            'categories' => 'required|string',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|string|max:255',
        ];
    }
}