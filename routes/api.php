<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LoginController; 
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ResourceController;


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
    Route::get('/processes', [ProcessController::class, 'index'])->middleware('role:Administrator|Manager');
    Route::post('/processes', [ProcessController::class, 'store'])->middleware('role:Administrator|Manager');
    Route::put('/processes/{id}', [ProcessController::class, 'update'])->middleware('role:Administrator|Manager');
    Route::delete('/processes/{id}', [ProcessController::class, 'destroy'])->middleware('role:Administrator|Manager');
    });
// Floor Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/floors', [FloorController::class, 'index'])->middleware('role:Administrator|Manager');
    Route::post('/floors', [FloorController::class, 'store'])->middleware('role:Administrator|Manager');
    Route::put('/floors/{id}', [FloorController::class, 'update'])->middleware('role:Administrator|Manager');
    Route::delete('/floors/{id}', [FloorController::class, 'destroy'])->middleware('role:Administrator|Manager');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/teams', [TeamController::class, 'index']) ->middleware('role:Administrator|Manager');
    Route::post('/teams', [TeamController::class, 'store'])->middleware('role:Administrator|Manager');
    Route::put('/teams/{id}', [TeamController::class, 'update'])->middleware('role:Administrator|Manager');
    Route::delete('/teams/{id}', [TeamController::class, 'destroy'])->middleware('role:Administrator|Manager');
});

// Schedule Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/schedules', [ScheduleController::class, 'index'])->middleware('role:Administrator|Manager');
    Route::post('/schedules', [ScheduleController::class, 'store'])->middleware('role:Administrator|Manager');
    Route::put('/schedules/{id}', [ScheduleController::class, 'update'])->middleware('role:Administrator|Manager');
    Route::delete('/schedules/{id}', [ScheduleController::class, 'destroy'])->middleware('role:Administrator|Manager');
});

// Resource Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/resources', [ResourceController::class, 'index'])->middleware('role:Administrator|Manager');
    Route::post('/resources', [ResourceController::class, 'store'])->middleware('role:Administrator|Manager');
    Route::put('/resources/{id}', [ResourceController::class, 'update'])->middleware('role:Administrator|Manager');
    Route::delete('/resources/{id}', [ResourceController::class, 'destroy'])->middleware('role:Administrator|Manager');
});