<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SpinWheelController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Authentication Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Retailer Routes (Role-based access)
Route::middleware(['auth:sanctum', 'role:Retailer'])->group(function () {
    Route::post('/spin/free', [SpinWheelController::class, 'useFreeSpin']);
    Route::post('/spin/buy', [SpinWheelController::class, 'buySpin']);
    Route::get('/spin/history', [SpinWheelController::class, 'getSpinHistory']);
});

// Admin Routes (Role-based access)
Route::middleware(['auth:sanctum', 'role:Admin'])->group(function () {
    Route::get('/admin/spin/history', [SpinWheelController::class, 'getAllSpinHistory']);
});
