<?php

namespace App\Http\Requests;

use App\Models\Schedule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateScheduleRequest extends FormRequest
{
    public function authorize()
    {
        $schedule = Schedule::find($this->route('id'));

        if (!$schedule) {
            return false;
        }

        if (auth()->user()->hasRole('Administrator')) {
            return true;
        }

        return auth()->user()->hasRole('Manager') && auth()->user()->company_id === $schedule->process->company_id;
    }

    public function rules()
    {
        return [
            'process_id' => 'sometimes|required|exists:processes,id',
            'schedule_type' => 'sometimes|required|string',
            'start_time' => 'sometimes|required|string',
            'end_time' => 'sometimes|required|string',
        ];
    }
}