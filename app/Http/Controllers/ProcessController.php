<?php

namespace App\Http\Controllers;

use App\Models\Processes;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    public function index()
    {
       
        return response()->json(Processes::all());
    }

    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

       
        $process = Processes::create($validated);
        return response()->json($process, 201);
    }

    public function show($id)
    {
        $process = Processes::findOrFail($id);
        return response()->json($process);
    }

    public function update(Request $request, $id)
    {
        
        $process = Processes::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $process->update($validated);
        return response()->json($process);
    }

    public function destroy($id)
    {
        
        $process = Processes::findOrFail($id);
        $process->delete();

        return response()->json(null, 204);
    }
}