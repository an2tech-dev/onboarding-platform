<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Http\Requests\StoreResourceRequest;
use App\Http\Requests\UpdateResourceRequest;

class ResourceController extends Controller
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

        $products = Resource::where('company_id', $user->company_id)->get();

        return response()->json($products, 200);
    }

    public function store(StoreResourceRequest $request)
    {
        $data = $request->validated();

        if (auth()->user()->hasRole('Manager') && $data['company_id'] !== auth()->user()->company_id) {
            return response()->json(['error' => 'Unauthorized to create a resource for this company'], 403);
        }

        try {
            $resource = Resource::create($data);
            return response()->json(['message' => 'Resource created successfully!', 'resource' => $resource], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Resource could not be created'], 500);
        }
    }

    public function update(UpdateResourceRequest $request, $id)
    {
        $data = $request->validated();
        $resource = Resource::findOrFail($id);

        if (auth()->user()->hasRole('Manager') && $resource->company_id !== auth()->user()->company_id) {
            return response()->json(['error' => 'Unauthorized to update this resource'], 403);
        }

        try {
            $resource->update($data);
            return response()->json(['message' => 'Resource updated successfully!', 'resource' => $resource]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Resource could not be updated'], 500);
        }
    }

    public function destroy($id)
    {
        $resource = Resource::findOrFail($id);

        if (auth()->user()->hasRole('Manager') && $resource->company_id !== auth()->user()->company_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        try {
            $resource->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Resource could not be deleted'], 500);
        }
    }
}