<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['role:Administrator|Manager'])->group(function () {
    Route::get('/company', [CompanyController::class, 'index']);
    Route::post('/company', [CompanyController::class, 'store']);
    Route::put('/company/{id}', [CompanyController::class, 'update']);
    Route::delete('/company/{id}', [CompanyController::class, 'destroy']);
});

