<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Process;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function __construct()
    {
        // Ensure only administrators and managers have access to these methods
        $this->middleware(['role:Administrator|Manager'])->only(['index', 'store', 'update', 'destroy']);
    }

    public function index()
    {
        if (auth()->user()->hasRole('Administrator')) {
            return response()->json(Schedule::all());
        } else {
            return response()->json(Schedule::whereHas('process', function ($query) {
                $query->where('company_id', auth()->user()->company_id);
            })->get());
        }
    }

    public function store(StoreScheduleRequest $request)
    {
        $data = $request->validated();

        // Ensure managers can only create schedules for processes in their own company
        $process = Process::findOrFail($data['process_id']);
        if (auth()->user()->hasRole('Manager') && $process->company_id !== auth()->user()->company_id) {
            return response()->json(['error' => 'Unauthorized to create a schedule for this process'], 403);
        }

        try {
            $schedule = Schedule::create($data);
            return response()->json(['message' => 'Schedule created successfully!', 'schedule' => $schedule], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Schedule could not be created'], 500);
        }
    }

    public function update(UpdateScheduleRequest $request, $id)
    {
        $data = $request->validated();
        $schedule = Schedule::findOrFail($id);

        // Ensure managers can only update schedules related to their own company's processes
        if (auth()->user()->hasRole('Manager') && $schedule->process->company_id !== auth()->user()->company_id) {
            return response()->json(['error' => 'Unauthorized to update this schedule'], 403);
        }

        try {
            $schedule->update($data);
            return response()->json(['message' => 'Schedule updated successfully!', 'schedule' => $schedule]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Schedule could not be updated'], 500);
        }
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);

        // Ensure managers can only delete schedules related to their own company's processes
        if (auth()->user()->hasRole('Manager') && $schedule->process->company_id !== auth()->user()->company_id) {
            return response()->json(['error' => 'Unauthorized to delete this schedule'], 403);
        }

        $schedule->delete();
        return response()->json(null, 204);
    }
}
