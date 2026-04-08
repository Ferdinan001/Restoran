<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ===== PUBLIC ROUTES (NO AUTHENTICATION REQUIRED) =====

// Food/Menu Endpoints (Public)
Route::prefix('public')->group(function () {
    /**
     * GET /api/public/foods - Get all foods/menus
     * GET /api/public/foods/{id} - Get single food/menu
     */
    Route::get('/foods', [\App\Http\Controllers\Api\FoodController::class, 'index']);
    Route::get('/foods/{id}', [\App\Http\Controllers\Api\FoodController::class, 'show']);
});

// ===== PROTECTED ROUTES (AUTHENTICATION REQUIRED) =====

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Food Management Endpoints (Protected - requires authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/foods', [\App\Http\Controllers\Api\FoodController::class, 'store']);
    Route::put('/foods/{id}', [\App\Http\Controllers\Api\FoodController::class, 'update']);
    Route::delete('/foods/{id}', [\App\Http\Controllers\Api\FoodController::class, 'destroy']);
});
