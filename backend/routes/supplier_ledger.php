<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SupplierLedger\SearchSupplierLedgerController;
use App\Http\Controllers\SupplierLedger\ReadAllSupplierLedgerController;
use App\Http\Controllers\SupplierLedger\CreateSupplierLedgerController;
use App\Http\Controllers\SupplierLedger\FetchBySupplierPurchaseController;

Route::post('', CreateSupplierLedgerController::class);
Route::get('', ReadAllSupplierLedgerController::class);
Route::get('search', SearchSupplierLedgerController::class);
Route::get('suppliers/{supplierId}/purchases/{purchaseId}', FetchBySupplierPurchaseController::class);
