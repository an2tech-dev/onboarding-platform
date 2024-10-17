<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFloorRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('create floor');
    }

    public function rules()
    {
        return [
            'company_id' => 'required|exists:company,id',
            'name' => 'required|string|max:255',
            'floor_number' => 'required|integer',
        ];
    }
}