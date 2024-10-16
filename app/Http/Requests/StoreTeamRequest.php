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
        return [
            'floor_id' => 'required|exists:floors,id',
            'name' => 'required|string|max:255',
            'members_count' => 'required|integer',
        ];
    }
}