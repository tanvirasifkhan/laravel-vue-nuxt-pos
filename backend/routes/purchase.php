<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Purchase\CreatePurchaseController;
use App\Http\Controllers\Purchase\ReadAllPurchaseController;
use App\Http\Controllers\Purchase\SearchPurchaseController;

Route::post('', CreatePurchaseController::class);
Route::get('', ReadAllPurchaseController::class);
Route::get('search', SearchPurchaseController::class);
