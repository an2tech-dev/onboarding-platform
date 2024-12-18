<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('create company');
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'established' => 'nullable|date',
            'office_size' => 'nullable|integer',
            'benefits' => 'nullable|array',
        ];
    }
}