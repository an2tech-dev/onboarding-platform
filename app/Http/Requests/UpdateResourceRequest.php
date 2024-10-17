<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Resource;

class UpdateResourceRequest extends FormRequest
{
    public function authorize()
    {
        $resource = Resource::find($this->route('id'));

        if (!$resource) {
            return false;
        }

        if (auth()->user()->hasRole('Administrator')) {
            return true;
        }

        return auth()->user()->hasRole('Manager') && auth()->user()->company_id === $resource->company_id;
    }

    public function rules()
    {
        return [
            'company_id' => 'sometimes|required|exists:company,id',
            'categories' => 'sometimes|required|string',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'sometimes|required|string|max:255',
        ];
    }
}