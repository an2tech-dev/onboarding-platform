<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use GuzzleHttp\Psr7\Request;

class CompanyController extends Controller  
{
    public function __construct()
    {
        $this->middleware(['role:Administrator|Manager'])->only(['update']);
        $this->middleware(['role:Administrator'])->only(['store', 'destroy']);
        $this->middleware(['role:Administrator|Manager'])->only(['index', 'show']);
    }

    public function index()
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $companies = auth()->user()->company ? [auth()->user()->company] : [];

        return response()->json($companies, 200);
    }

    public function store(StoreCompanyRequest $request)
    {
        $company = Company::create($request->validated());
        return response()->json($company, 201);
    }

    public function update(UpdateCompanyRequest $request, $id)
    {
        $company = Company::findOrFail($id);

        if (auth()->user()->hasRole('Manager') && auth()->user()->company_id !== $company->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $company->update($request->validated());

        return response()->json($company);
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return response()->json(null, 204);
    }

    public function userCompany()
    {
        $user = Auth::user();


        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        if (!$user->company_id) {
            return response()->json(['message' => 'User is not associated with any company'], 404);
        }

        $company = $user->company;

        return response()->json([
            'company' => $company,
        ], 200);
    }
}