<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Process;

class UpdateProcessRequest extends FormRequest
{
    public function authorize()
    {
        $process = Process::find($this->route('id'));

        if (!$process) {
            return false;
        }

        if (auth()->user()->hasRole('Administrator')) {
            return true;
        }

        if (auth()->user()->hasRole('Manager') && auth()->user()->company_id === $process->company_id) {
            return true;
        }

        return false;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];
    }
}

