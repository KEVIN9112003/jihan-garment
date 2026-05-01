<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Admin\ProductController as AdminProduct;
// Import CheckoutController jika kamu sudah membuatnya, 
// atau sementara gunakan ShopController jika logika checkout ada di sana.
use App\Http\Controllers\CheckoutController; 

// --- AREA UMUM & SHOP ---
Route::get('/', [ShopController::class, 'index'])->name('home');
Route::get('/product/{slug}', [ShopController::class, 'show'])->name('product.show');

// --- FITUR KERANJANG (CART) ---
Route::get('/cart', [ShopController::class, 'cart'])->name('cart.index');
Route::post('/add-to-cart/{id}', [ShopController::class, 'addToCart'])->name('cart.add');
Route::delete('/remove-from-cart/{id}', [ShopController::class, 'removeFromCart'])->name('cart.remove');

// --- FITUR CHECKOUT (INI YANG TADI ERROR) ---
// Kita masukkan ke middleware 'auth' karena biasanya checkout wajib login
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [ShopController::class, 'checkout'])->name('checkout.index');
    // Jika kamu punya controller khusus checkout, gunakan ini:
    // Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
});

// --- AUTHENTICATION ---
Route::get('/login', [ShopController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [ShopController::class, 'login']);
Route::get('/register', [ShopController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [ShopController::class, 'register']);
Route::post('/logout', [ShopController::class, 'logout'])->name('logout');

// --- AREA ADMIN (JIHAN GARMENT) ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/products', [AdminProduct::class, 'index'])->name('products.index');
    Route::get('/products/create', [AdminProduct::class, 'create'])->name('products.create');
    Route::post('/products/store', [AdminProduct::class, 'store'])->name('products.store');
    
    Route::get('/products/{id}/edit', [AdminProduct::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [AdminProduct::class, 'update'])->name('products.update');
    
    Route::delete('/products/{id}', [AdminProduct::class, 'destroy'])->name('products.destroy');
});