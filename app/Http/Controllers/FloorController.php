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
        if (!auth()->check()) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $user = auth()->user();

        if (!$user->company_id) {
            return response()->json(['message' => 'User is not associated with any company'], 404);
        }

        $floors = Floor::where('company_id', $user->company_id)
        ->with(['teams.products'])
        ->get();


        return response()->json($floors, 200);
    }

    public function store(StoreFloorRequest $request)
    {
        $data = $request->validated();
    
        if (auth()->user()->hasRole('Manager') && $data['company_id'] !== auth()->user()->company_id) {
            return response()->json(['error' => 'Unauthorized to create a floor for this company'], 403);
        }
    
        try {
            $floor = Floor::create($data);
            
            // If teams were selected, attach them to the floor
            if (isset($data['teams'])) {
                $floor->teams()->sync($data['teams']);
            }
            
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
            
            if (isset($data['teams'])) {
                $floor->save();
            }
            
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