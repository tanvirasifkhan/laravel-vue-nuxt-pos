<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Supplier\CreateSupplierController;
use App\Http\Controllers\Supplier\ReadAllSupplierController;
use App\Http\Controllers\Supplier\ReadSupplierController;
use App\Http\Controllers\Supplier\UpdateSupplierController;
use App\Http\Controllers\Supplier\DeleteSupplierController;

Route::post('', CreateSupplierController::class);
Route::get('', ReadAllSupplierController::class);
Route::get('{id}', ReadSupplierController::class);
Route::put('{id}', UpdateSupplierController::class);
Route::delete('{id}', DeleteSupplierController::class);
