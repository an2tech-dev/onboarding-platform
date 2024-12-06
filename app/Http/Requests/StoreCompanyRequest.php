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
            'established' => 'required|date',
            'team_members' => 'required|integer',
            'office_size' => 'required|integer',
            'floors' => 'nullable|string|max:255', 
            'benefits' => 'nullable|string|max:255',

        ];
    }
}