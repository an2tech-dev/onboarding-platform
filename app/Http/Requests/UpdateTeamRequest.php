<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Team;

class UpdateTeamRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('update team');
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'members_count' => 'sometimes|required|integer',
        ];
    }
}