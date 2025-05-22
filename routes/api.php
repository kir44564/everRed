<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Authenticated User
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// User Resource Routes
Route::prefix('utenti')->group(function () {
    Route::get('/', [ApiController::class, 'index']);          // List users
    Route::get('/{id}', [ApiController::class, 'show']);       // Show user
    Route::post('/', [ApiController::class, 'store']);         // Create user
    Route::put('/{id}', [ApiController::class, 'update']);     // Update user
    Route::delete('/{id}', [ApiController::class, 'destroy']); // Delete user
});

// API Routes (if using Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('api/logout', function (Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    })->name('api.logout');
});