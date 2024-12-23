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
            'name' => 'required|string|max:255',
            'floor_number' => 'required|integer',
            'type' => 'required|in:Office Floor,Other Activities',
            'company_id' => auth()->user()->hasRole('Administrator') ? 'required|exists:company,id' : 'sometimes',
            'teams' => 'nullable|array',
            'teams.*' => 'exists:teams,id'
        ];
    }

    protected function prepareForValidation()
    {
        if (auth()->user()->hasRole('Manager')) {
            $this->merge([
                'company_id' => auth()->user()->company_id,
            ]);
        }
    }
}