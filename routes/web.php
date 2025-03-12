<?php

use App\Http\Controllers\CartController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Mostrar el carrito
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    // Agregar un producto al carrito
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');

    // Eliminar un producto del carrito
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');