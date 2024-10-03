<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    public function index()
    {
        return response()->json(Floor::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:company,id',
            'name' => 'required|string|max:255',
            'floor_number' => 'required|integer',
        ]);

        $floor = Floor::create($validated);
        return response()->json($floor, 201);
    }

    public function update(Request $request, $id)
    {
        $floor = Floor::findOrFail($id);

        $validated = $request->validate([
            'company_id' => 'required|exists:company,id',
            'name' => 'required|string|max:255',
            'floor_number' => 'required|integer',
        ]);

        $floor->update($validated);
        return response()->json($floor);
    }

    public function destroy($id)
    {
        $floor = Floor::findOrFail($id);
        $floor->delete();
        return response()->json(null, 204);
    }
}