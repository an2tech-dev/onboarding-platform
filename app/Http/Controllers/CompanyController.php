<?php
namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct()
{
    $this->middleware('role:Administrator|Manager')->only(['index', 'show']);
    $this->middleware('role:Administrator')->except(['index', 'show']);
}
    public function index()
    {

        if (auth()->user()->hasRole('Administrator')) {
            return response()->json(Company::all());
        }

        if (auth()->user()->hasRole('Manager')) {
            return response()->json(auth()->user()->company);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'established' => 'required|integer',
            'team_members' => 'required|integer',
            'office_size' => 'required|integer',
        ]);

        $company = Company::create($validated);
        return response()->json($company, 201);
    }

    public function show($id)
    {
        $company = Company::findOrFail($id);

        if (auth()->user()->hasRole('Administrator')) {
            return response()->json($company);
        }

        if (auth()->user()->hasRole('Manager') && auth()->user()->company_id === $company->id) {
            return response()->json($company);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        if (auth()->user()->hasRole('Administrator')) {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'established' => 'required|integer',
                'team_members' => 'required|integer',
                'office_size' => 'required|integer',
            ]);

            $company->update($validated);
            return response()->json($company);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);

        if (auth()->user()->hasRole('Administrator')) {
            $company->delete();
            return response()->json(null, 204);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
