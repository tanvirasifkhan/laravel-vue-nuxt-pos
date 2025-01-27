<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'Laravel Vue Nuxt POS API',
        'status' => 200,
        'language' => 'PHP ' . phpversion(),
        'framework' => config('app.name') . ' ' . app()->version()
    ]);
});
