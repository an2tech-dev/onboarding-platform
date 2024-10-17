<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProcessRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('create process');
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'company_id' => 'required|exists:company,id', // Ensure that the process belongs to a valid company
        ];
    }
}
