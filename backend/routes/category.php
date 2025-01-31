<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Category\CreateCategoryController;
use App\Http\Controllers\Category\ReadAllCategoryController;
use App\Http\Controllers\Category\ReadCategoryController;
use App\Http\Controllers\Category\UpdateCategoryController;
use App\Http\Controllers\Category\DeleteCategoryController;
use App\Http\Controllers\Category\SearchCategoryController;

Route::post('', CreateCategoryController::class);
Route::get('', ReadAllCategoryController::class);
Route::get('search/{keyword}', SearchCategoryController::class);
Route::get('{id}', ReadCategoryController::class);
Route::put('{id}', UpdateCategoryController::class);
Route::delete('{id}', DeleteCategoryController::class);
