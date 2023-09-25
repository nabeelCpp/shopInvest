<?php

use App\Http\Controllers\{ProfileController, FrontController};
use App\Http\Controllers\dashboard\{DashboardController, BrandController, ProductController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontController::class, 'index'])->name("home");

Route::get('/product/{productId}', [FrontController::class, 'product'])->name("product.details");

/**
 * Brands per page.
 */
Route::get('/{brand}', [FrontController::class, 'brand'])->name("brand");


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /**
     * Brands Routes
     */
    Route::prefix('brands')->group(function() {
        Route::get('', [BrandController::class, 'index'])->name('brands');
        Route::post('', [BrandController::class, 'store'])->name('brands.store');
        Route::patch('/{id}', [BrandController::class, 'update'])->name('brands.update');
        Route::delete('/{id}', [BrandController::class, 'destroy'])->name('brands.destroy');
    });


    /**
     * Products Routes
     */
    Route::prefix('products')->group(function() {
        Route::get('', [ProductController::class, 'index'])->name('products');
        Route::get('/create', [ProductController::class, 'create'])->name('products.create');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
        Route::post('', [ProductController::class, 'store'])->name('products.store');
        Route::patch('/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

    /**
     * Images Routes
     */

    Route::delete('/images/{id}', [ProductController::class, 'removeImage'])->name('images.remove');
});


require __DIR__.'/auth.php';
