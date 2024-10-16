<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LoginController; 
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProcessesController;

use App\Http\Controllers\FloorController;
use App\Http\Controllers\TeamController;


Route::post('/login', [LoginController::class, 'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/company', [CompanyController::class, 'index'])->middleware('role:Administrator|Manager');
    Route::post('/company', [CompanyController::class, 'store'])->middleware('role:Administrator');
    Route::put('/company/{id}', [CompanyController::class, 'update'])->middleware('role:Administrator|Manager');
    Route::delete('/company/{id}', [CompanyController::class, 'destroy'])->middleware('role:Administrator');
    
});

// Product Routes
Route::middleware(['auth:sanctum'])->group(function () {
Route::get('/products', [ProductController::class, 'index'])->middleware('role:Administrator|Manager');
Route::post('/products', [ProductController::class, 'store'])->middleware('role:Administrator|Manager');
Route::put('/products/{id}', [ProductController::class, 'update'])->middleware('role:Administrator|Manager');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->middleware('role:Administrator|Manager');
});

// Processes Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/processes', [ProcessesController::class, 'index'])->middleware('role:Administrator|Manager');
    Route::post('/processes', [ProcessesController::class, 'store'])->middleware('role:Administrator|Manager');
    Route::put('/processes/{id}', [ProcessesController::class, 'update'])->middleware('role:Administrator|Manager');
    Route::delete('/processes/{id}', [ProcessesController::class, 'destroy'])->middleware('role:Administrator');
    });
// Floor Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/floors', [FloorController::class, 'index'])->middleware('role:Administrator|Manager');
    Route::post('/floors', [FloorController::class, 'store'])->middleware('role:Administrator|Manager');
    Route::put('/floors/{id}', [FloorController::class, 'update'])->middleware('role:Administrator|Manager');
    Route::delete('/floors/{id}', [FloorController::class, 'destroy'])->middleware('role:Administrator');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/teams', [TeamController::class, 'index']) ->middleware('role:Administrator|Manager');
    Route::post('/teams', [TeamController::class, 'store'])->middleware('role:Administrator|Manager');
    Route::put('/teams/{id}', [TeamController::class, 'update'])->middleware('role:Administrator|Manager');
    Route::delete('/teams/{id}', [TeamController::class, 'destroy'])->middleware('role:Administrator|Manager');
});
