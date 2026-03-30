<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Menggunakan App\Http\Controllers\Api\FoodController
Route::apiResource('/foods', \App\Http\Controllers\Api\FoodController::class);
