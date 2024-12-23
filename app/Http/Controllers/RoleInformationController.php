<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Models\RoleInformation;


class RoleInformationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Administrator|Manager'])->only(['index', 'store', 'update', 'destroy']);
    }
   
    public function index()
    {
        $user = $this->getAuthenticatedUser();
        $this->checkUserCompany($user);
        $roleInformation = $this->getRoleInformation($user);
        $teamData = $this->getTeamData($user);

        return response()->json([
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
            ],
            'role_information' => $roleInformation,
            'team' => $teamData['name'],
            'products' => $teamData['products'],
        ], 200);
    }

    private function getAuthenticatedUser()
    {
        if (!auth()->check()) {
            abort(response()->json(['message' => 'User not authenticated'], 401));
        }

        return auth()->user();
    }

    private function checkUserCompany($user)
    {
        if (!$user->company_id) {
            abort(response()->json(['message' => 'User is not associated with any company'], 404));
        }
    }

    private function getRoleInformation($user)
    {
        $roleInformation = RoleInformation::where('id', $user->role_information_id)
            ->where('company_id', $user->company_id)
            ->first();

        if (!$roleInformation) {
            abort(response()->json(['message' => 'No role information found for the user'], 404));
        }

        return $roleInformation;
    }

    private function getTeamData($user)
    {
        if (!$user->team_id) {
            abort(response()->json(['message' => 'User is not assigned to any team'], 404));
        }

        $team = Team::with('products')->where('id', $user->team_id)->first();

        if (!$team) {
            abort(response()->json(['message' => 'Team not found'], 404));
        }

        return [
            'name' => $team->name,
            'products' => $team->products->pluck('name'),
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
