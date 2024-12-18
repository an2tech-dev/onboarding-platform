<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('Administrator')) {
            return response()->json(User::all());
        }

        if (Auth::user()->hasRole('Manager')) {
            return response()->json(User::where('company_id', Auth::user()->company_id)->get());
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }

    public function store(Request $request)
    {
        if (!Auth::user()->hasRole(['Administrator', 'Manager'])) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'team_id' => 'required|exists:teams,id',
        ]);

        // If manager, validate team belongs to their company
        if (Auth::user()->hasRole('Manager')) {
            $team = Team::find($validated['team_id']);
            if ($team->company_id !== Auth::user()->company_id) {
                return response()->json(['error' => 'Unauthorized to assign user to this team'], 403);
            }
            $validated['company_id'] = Auth::user()->company_id;
        }

        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        // Assign role based on creator
        if (Auth::user()->hasRole('Manager')) {
            $user->assignRole('Employee');
        } else {
            if ($request->has('roles')) {
                $user->syncRoles($request->roles);
            }
        }

        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        if (Auth::user()->hasRole('Manager') && $user->company_id !== Auth::user()->company_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (Auth::user()->hasRole('Manager') && $user->company_id !== Auth::user()->company_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Add your update logic here
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (Auth::user()->hasRole('Manager') && $user->company_id !== Auth::user()->company_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $user->delete();
        return response()->json(null, 204);
    }
}