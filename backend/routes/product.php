<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Product\CreateProductController;
use App\Http\Controllers\Product\ReadAllProductController;
use App\Http\Controllers\Product\ReadProductController;
use App\Http\Controllers\Product\UpdateProductController;
use App\Http\Controllers\Product\DeleteProductController;
use App\Http\Controllers\Product\SearchProductController;

Route::post('', CreateProductController::class);
Route::get('', ReadAllProductController::class);
Route::get('search', SearchProductController::class);
Route::get('{id}', ReadProductController::class);
Route::put('{id}', UpdateProductController::class);
Route::delete('{id}', DeleteProductController::class);
