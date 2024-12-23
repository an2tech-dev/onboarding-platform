<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Team;

class UpdateTeamRequest extends FormRequest
{
    public function authorize()
    {
        $team = Team::find($this->route('id'));

        if (!$team) {
            return false;
        }

        if (auth()->user()->hasRole('Administrator')) {
            return true;
        }

        return auth()->user()->hasRole('Manager') && auth()->user()->company_id === $team->company_id;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:5120', // 5MB max
        ];
    }
}