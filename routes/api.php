<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Auth\LoginController; 
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;

// Login Route
Route::post('/login', [LoginController::class, 'login']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'role:Administrator|Manager'])->group(function () {
    Route::get('/company', [CompanyController::class, 'index']); // Managers and Administrators can view
});

Route::middleware(['auth:sanctum', 'role:Administrator'])->group(function () {
    Route::post('/company', [CompanyController::class, 'store']); // Only Administrators can create
    Route::put('/company/{id}', [CompanyController::class, 'update']); // Only Administrators can update
    Route::delete('/company/{id}', [CompanyController::class, 'destroy']); // Only Administrators can delete
});