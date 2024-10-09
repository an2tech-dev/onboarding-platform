<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Models\User;

// Login Route
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if ($user && password_verify($request->password, $user->password)) {
        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
        ]);
    }

    return response()->json(['message' => 'Unauthorized'], 401);
});
Route::middleware(['role:Administrator'])->group(function () {
    Route::post('/company', [CompanyController::class, 'store']);
    Route::put('/company/{id}', [CompanyController::class, 'update']);
    Route::delete('/company/{id}', [CompanyController::class, 'destroy']);
});

Route::middleware(['role:Administrator|Manager'])->group(function () {
    Route::get('/company', [CompanyController::class, 'index']);
    Route::get('/company/{id}', [CompanyController::class, 'show']);
});
