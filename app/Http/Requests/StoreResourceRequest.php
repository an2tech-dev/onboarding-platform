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
            'url' => 'string|max:255',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240', // 10MB max size
        ];
    }
}