<?php

namespace App\Http\Controllers;

use App\Models\Schedules;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
     
        return response()->json(Schedules::all());
    }

    public function store(Request $request)
    {
 
        $validated = $request->validate([
            'process_id' => 'required|exists:processes,id',
            'schedule_type' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
        ]);

      
        $schedule = Schedules::create($validated);
        return response()->json($schedule, 201);
    }

    public function show($id)
    {
        $schedule = Schedules::findOrFail($id);
        return response()->json($schedule);
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedules::findOrFail($id);

       
        $validated = $request->validate([
            'process_id' => 'required|exists:processes,id',
            'schedule_type' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
        ]);

        $schedule->update($validated);
        return response()->json($schedule);
    }

    public function destroy($id)
    {
        
        $schedule = Schedules::findOrFail($id);
        $schedule->delete();

        return response()->json(null, 204);
    }
}