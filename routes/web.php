<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Simple root route for confirmation
Route::get('/', function () {
    return response()->json(['message' => 'Welcome to the Laravel Backend API']);
});

// Authenticated profile routes (API-only, without views)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include auth routes (login, register, etc.)
require __DIR__.'/auth.php';

// Custom logout route
Route::post('/logout', function () {
    Auth::logout();
    return response()->json(['message' => 'Logged out successfully']);
})->name('logout');