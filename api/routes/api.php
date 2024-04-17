<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['SetLanguage'])->group(function () {
    Route::get('/{lang}/products', [ProductController::class, 'index']);
    Route::get('/{lang}/products/{id}', [ProductController::class, 'show'])->where('id', '[1-9][0-9]*');
    Route::post('/{lang}/products', [ProductController::class, 'store']);
    Route::put('/{lang}/products/{id}', [ProductController::class, 'update'])->where('id', '[1-9][0-9]*');
    Route::delete('/{lang}/products/{id}', [ProductController::class, 'destroy'])->where('id', '[1-9][0-9]*');

    Route::get('/{lang}/categories', [CategoryController::class, 'index']);
    Route::get('/{lang}/categories/{id}', [CategoryController::class, 'show'])->where('id', '[1-9][0-9]*');
    Route::post('/{lang}/categories', [CategoryController::class, 'store']);
    Route::put('/{lang}/categories/{id}', [CategoryController::class, 'update'])->where('id', '[1-9][0-9]*');
});
