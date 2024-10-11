<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LoginController; 

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