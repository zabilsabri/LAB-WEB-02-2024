<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryLogController;

Route::get('/', [ProductController::class, 'index']); // Halaman Utama

Route::resource('categories', CategoryController::class); // Rute untuk CRUD ktaegori

Route::resource('products', ProductController::class); // Rute untuk CRUD Produk

Route::post('products/{product}/inventory', [InventoryLogController::class, 'store'])->name('inventory.store'); // Route untuk menambah log inventori (restock atau sold) pada produk

Route::delete('inventory_logs/{id}', [InventoryLogController::class, 'destroy'])->name('inventory.destroy'); // Route untuk menghapus log inventori tertentu
