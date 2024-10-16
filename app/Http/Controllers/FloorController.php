<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use App\Http\Requests\StoreFloorRequest;
use App\Http\Requests\UpdateFloorRequest;

class FloorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Administrator|Manager'])->only(['index', 'store', 'update', 'destroy']);
    }

    public function index()
    {
        if (auth()->user()->hasRole('Administrator')) {
            return response()->json(Floor::all());
        } else {
            return response()->json(Floor::where('company_id', auth()->user()->company_id)->get());
        }
    }

    public function store(StoreFloorRequest $request)
    {
        $data = $request->validated();
    
        if (auth()->user()->hasRole('Manager') && $data['company_id'] !== auth()->user()->company_id) {
            return response()->json(['error' => 'Unauthorized to create a floor for this company'], 403);
        }
    
        try {
            $floor = Floor::create($data);
            return response()->json(['message' => 'Floor created successfully!', 'floor' => $floor], 201); 
        } catch (\Exception $e) {
            return response()->json(['error' => 'Floor could not be created'], 500);
        }
    }

    public function update(UpdateFloorRequest $request, $id)
{
    $data = $request->validated();
    $floor = Floor::findOrFail($id);

    if (auth()->user()->hasRole('Manager') && $floor->company_id !== auth()->user()->company_id) {
        return response()->json(['error' => 'Unauthorized to update this floor'], 403);
    }

    try {
        $floor->update($data);
        return response()->json(['message' => 'Floor updated successfully!', 'floor' => $floor]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Floor could not be updated'], 500);
    }
}

    public function destroy($id)
    {
        $floor = Floor::findOrFail($id);

        if (auth()->user()->hasRole('Manager') && auth()->user()->company_id !== $floor->company_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $floor->delete();
        return response()->json(null, 204);
    }
}