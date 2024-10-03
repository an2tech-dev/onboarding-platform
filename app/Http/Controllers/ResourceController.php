<?php

namespace App\Http\Controllers;

use App\Models\Resources;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index()
    {
        return response()->json(Resources::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url',
        ]);

        $resource = Resources::create($validated);
        return response()->json($resource, 201);
    }

    public function show($id)
    {
        $resource = Resources::findOrFail($id);
        return response()->json($resource);
    }

    public function update(Request $request, $id)
    {
        $resource = Resources::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url',
        ]);

        $resource->update($validated);
        return response()->json($resource);
    }

    public function destroy($id)
    {
        $resource = Resources::findOrFail($id);
        $resource->delete();

        return response()->json(null, 204);
    }
}
