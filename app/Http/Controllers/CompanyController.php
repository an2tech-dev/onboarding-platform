<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $company = Company::all();
        return response()->json($company);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string',
            'established_year' => 'required|integer|digits:4',
            'team_members' => 'required|integer',
            'office_size' => 'required|integer',
            'floors' => 'required|string',
        ]);

        $company = Company::create($validated);
        return response()->json($company, 201);
    }

    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $validated = $request->validate([
            'description' => 'sometimes|required|string',
            'established_year' => 'sometimes|required|integer|digits:4',
            'team_members' => 'sometimes|required|integer',
            'office_size' => 'sometimes|required|integer',
            'floors' => 'sometimes|required|string',
        ]);

        $company->update($validated);

        return response()->json($company, 200);
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return response()->json(null, 204);
    }
}
