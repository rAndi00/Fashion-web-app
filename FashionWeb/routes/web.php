<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    // Display all products
    Route::get('products', [ProductController::class, 'index'])->name('products.index');

    // Show form to create a new product
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');

    // Store a new product
    Route::post('products', [ProductController::class, 'store'])->name('products.store');

    // Show form to edit a product
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

    // Update a product
    Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');

    // Delete a product
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

require __DIR__.'/auth.php';
