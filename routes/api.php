<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;    
use App\Http\Controllers\SalesController;           
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UsersController;

Route::get('/users', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('users', UsersController::class); 
Route::resource('categories', CategoriesController::class); 
Route::resource('products', ProductsController::class);
Route::resource('sales', SalesController::class);
Route::resource('reports', ReportsController::class);   