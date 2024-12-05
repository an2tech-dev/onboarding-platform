<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Company;

class UpdateCompanyRequest extends FormRequest
{
    public function authorize()
    {
        $company = Company::find($this->route('id'));

        if (!$company) {
            return false; 
        }

        if (auth()->user()->hasRole('Administrator')) {
            return true;
        }

        if (auth()->user()->hasRole('Manager') && auth()->user()->company_id === $company->id) {
            return true;
        }

        return false;
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