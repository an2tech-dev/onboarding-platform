<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller  
{
    public function __construct()
    {
        // Apply middleware to restrict actions to certain roles
        $this->middleware(['role:Administrator'])->only(['store', 'update', 'destroy']);
        $this->middleware(['role:Administrator|Manager'])->only(['index']);
    }

    // Fetch all companies (accessible to Managers and Administrators)
    public function index()
    {
        return response()->json(Company::all());
    }

    // Administrator can create a new company
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'established' => 'required|date',  
            'team_members' => 'required|integer',
            'office_size' => 'required|integer',
        ]);

        $company = Company::create($validated);
        return response()->json($company, 201);
    }

    // Administrator can update a company
    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

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

    // Administrator can delete a company
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return response()->json(null, 204);
    }
}