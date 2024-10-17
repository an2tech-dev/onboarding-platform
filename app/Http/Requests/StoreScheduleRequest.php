<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreScheduleRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('create schedule');
    }

    public function rules()
    {
        return [
            'process_id' => 'required|exists:processes,id',
            'schedule_type' => 'required|string',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
        ];
    }
}