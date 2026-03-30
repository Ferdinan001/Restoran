<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\foodController;

use App\Http\Controllers\FoodCategoryController;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('food', foodController::class);


Route::resource('food-category', FoodCategoryController::class);
