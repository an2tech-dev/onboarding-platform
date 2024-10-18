<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Floor;

class UpdateFloorRequest extends FormRequest
{
    public function authorize()
    {
        $floor = Floor::find($this->route('id'));

        if (!$floor) {
            return false; 
        }

        return auth()->user()->can('update floor'); 
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'floor_number' => 'sometimes|required|integer',
            'company_id' => 'sometimes|required|exists:company,id', 
        ];
    }
}