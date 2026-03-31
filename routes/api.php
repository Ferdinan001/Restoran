<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth: sanctum');

// Menggunakan App\Http\Controllers\Api\FoodController
Route::apiResource('/foods', \App\Http\Controllers\Api\FoodController::class);
