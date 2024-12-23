<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('create team');
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
        ];

        if (auth()->user()->hasRole('Administrator')) {
            $rules['company_id'] = 'required|exists:company,id';
        }

        return $rules;
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