<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Company::class);
        return response()->json(Company::all());
    }

    public function store(Request $request)
    {
        $this->authorize('create', Company::class);

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

    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        $this->authorize('update', $company);

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

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $this->authorize('delete', $company);

        $company->delete();
        return response()->json(null, 204);
    }
}
