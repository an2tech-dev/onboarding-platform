<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Floor;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Administrator|Manager'])->only(['index', 'store', 'update', 'destroy']);
    }

    public function index()
    {
        if (auth()->user()->hasRole('Administrator')) {
            return response()->json(Team::all());
        } else {
            return response()->json(Team::whereHas('floor', function ($query) {
                $query->where('company_id', auth()->user()->company_id);
            })->get());
        }
    }

    public function store(StoreTeamRequest $request)
    {
        $data = $request->validated();
        
        if (auth()->user()->hasRole('Manager') && !$this->isValidCompany($data['floor_id'])) {
            return response()->json(['error' => 'Unauthorized to create a team for this floor'], 403);
        }

        try {
            $team = Team::create($data);
            return response()->json(['message' => 'Team created successfully!', 'team' => $team], 201); 
        } catch (\Exception $e) {
            return response()->json(['error' => 'Team could not be created'], 500);
        }
    }

    public function update(UpdateTeamRequest $request, $id)
    {
        $data = $request->validated();
        $team = Team::findOrFail($id);

        if (auth()->user()->hasRole('Manager') && !$this->isValidCompany($team->floor->id)) {
            return response()->json(['error' => 'Unauthorized to update this team'], 403);
        }

        try {
            $team->update($data);
            return response()->json(['message' => 'Team updated successfully!', 'team' => $team]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Team could not be updated'], 500);
        }
    }

    public function destroy($id)
    {
        $team = Team::findOrFail($id);

        if (auth()->user()->hasRole('Manager') && !$this->isValidCompany($team->floor->id)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        try {
            $team->delete();
            return response()->json(['message' => 'Team deleted successfully!'], 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Team could not be deleted'], 500);
        }
    }

    private function isValidCompany($floorId)
    {
        $floor = Floor::find($floorId);
        
        return $floor && $floor->company_id == auth()->user()->company_id;
    }
}