<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InventoryLogController;

Route::get('/', [ProductController::class, 'index']);
Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('inventorylogs', InventoryLogController::class)->only(['index', 'store', 'destroy']);