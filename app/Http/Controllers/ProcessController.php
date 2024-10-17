<?php

namespace App\Http\Controllers;

use App\Models\Process;
use App\Http\Requests\StoreProcessRequest;
use App\Http\Requests\UpdateProcessRequest;

class ProcessController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Administrator|Manager'])->only(['index', 'show', 'store', 'destroy', 'update']);
    }

    public function index()
    {
        if (auth()->user()->hasRole('Administrator')) {
            return response()->json(Process::all());
        } else {
            return response()->json(Process::where('company_id', auth()->user()->company_id)->get());
        }
    }

    public function store(StoreProcessRequest $request)
    {
        $data = $request->validated();

        if (auth()->user()->hasRole('Manager')) {
            if ($data['company_id'] !== auth()->user()->company_id) {
                return response()->json(['error' => 'Unauthorized to create a process for this company'], 403);
            }
        }

        try {
            $process = Process::create($data);
            return response()->json($process, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Process could not be created'], 500);
        }
    }

    public function update(UpdateProcessRequest $request, $id)
    {
        $data = $request->validated();

        $process = Process::findOrFail($id);

        if (auth()->user()->hasRole('Manager')) {
            if ($process->company_id !== auth()->user()->company_id) {
                return response()->json(['error' => 'Unauthorized to update this process'], 403);
            }
        }

        try {
            $process->update($data);
            return response()->json($process);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Process could not be updated'], 500);
        }
    }

    public function destroy($id)
    {
        $process = Process::findOrFail($id);

        if (auth()->user()->hasRole('Manager') && auth()->user()->company_id !== $process->company_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $process->delete();
        return response()->json(null, 204);
    }
}
