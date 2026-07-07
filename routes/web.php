<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CustomerController;

use App\Http\Controllers\HomeController;

// Home 
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/products', [HomeController::class, 'products'])->name('products');
Route::get('/shop-by-category', [HomeController::class, 'shopByCategory'])->name('shop.by.category');

// Halaman Login untuk semua role
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute untuk pendaftaran
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

// Prefix dan namespace untuk admin
Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Route untuk produk
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [AdminProductController::class, 'index'])->name('index');
        Route::get('/create', [AdminProductController::class, 'create'])->name('create');
        Route::post('/', [AdminProductController::class, 'store'])->name('store');
        Route::get('/{product}', [AdminProductController::class, 'show'])->name('show');
        Route::get('/{product}/edit', [AdminProductController::class, 'edit'])->name('edit');
        Route::put('/{product}', [AdminProductController::class, 'update'])->name('update');
        Route::delete('/{product}', [AdminProductController::class, 'destroy'])->name('destroy');
    });

    // Route untuk orders (pesanan)
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [AdminOrderController::class, 'index'])->name('index');
        Route::get('/{order}', [AdminOrderController::class, 'show'])->name('show');
        Route::delete('/{order}', [AdminOrderController::class, 'destroy'])->name('destroy');
    });

    // route untuk membuat Category
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [AdminCategoryController::class, 'index'])->name('index');
        Route::get('/create', [AdminCategoryController::class, 'create'])->name('create');
        Route::post('/', [AdminCategoryController::class, 'store'])->name('store');
        Route::get('/{category}/edit', [AdminCategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}', [AdminCategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [AdminCategoryController::class, 'destroy'])->name('destroy');
    });

    // Route untuk pengguna (users)
    Route::get('/users', [AdminController::class, 'users'])->name('users.index'); // Add this line
});

// Bagian staff
Route::prefix('staff')->name('staff.')->middleware('role:staff')->group(function () {
    Route::get('/dashboard', [StaffController::class, 'dashboard'])->name('dashboard');
    Route::get('/products', [StaffController::class, 'products'])->name('products');
    Route::put('/products/{product}/update-stock', [StaffController::class, 'updateStock'])->name('products.update-stock');
    Route::get('/orders', [StaffController::class, 'orders'])->name('orders');
    Route::put('/orders/{order}/update-status', [StaffController::class, 'updateOrderStatus'])->name('orders.update-status');
});

// Rute untuk Customer
Route::prefix('customer')->name('customer.')->middleware('role:customer')->group(function () {
    // Dashboard
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
    
    // Bagian produk
    Route::get('/products', [CustomerController::class, 'products'])->name('products'); // Daftar Produk
    Route::get('/products/{id}', [CustomerController::class, 'showProduct'])->name('product.show'); // Detail Produk
    
    //Kategori
    // routes/web.php
    Route::get('/products/category', [CustomerController::class, 'searchByCategory'])->name('customer.searchByCategory');


    // Bagian keranjang
    Route::post('/cart/add', [CustomerController::class, 'addToCart'])->name('cart.add'); // Menambahkan produk ke keranjang
    Route::get('/cart', [CustomerController::class, 'viewCart'])->name('cart.view'); // Menampilkan keranjang belanja
    Route::delete('/cart/remove/{id}', [CustomerController::class, 'removeFromCart'])->name('cart.remove'); // Menghapus produk dari keranjang

    // Bagian order
    Route::post('/orders', [CustomerController::class, 'createOrder'])->name('orders.store'); // Membuat Pesanan
    Route::get('/orders', [CustomerController::class, 'orders'])->name('orders'); // Menampilkan Pesanan

    // Bagian checkout
    Route::get('/checkout', [CustomerController::class, 'checkout'])->name('checkout.index'); // Halaman Checkout
    Route::post('/checkout/process', [CustomerController::class, 'processCheckout'])->name('checkout.process'); // Memproses Checkout
    Route::get('/checkout/success', [CustomerController::class, 'checkoutSuccess'])->name('checkout.success'); // Halaman Sukses Checkout

    // Bagian profil
    Route::get('/profile', [CustomerController::class, 'profile'])->name('profile'); // Halaman Profil
    Route::get('/profile/edit', [CustomerController::class, 'editProfile'])->name('profile.edit'); // Halaman Edit Profil
    Route::put('/profile/update', [CustomerController::class, 'updateProfile'])->name('profile.update'); // Memperbarui Profil
});

// // Rute untuk Customer
// Route::prefix('customer')->name('customer.')->middleware('role:customer')->group(function () {
//     // Dashboard
//     Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
    
//     // Bagian produk
//     Route::get('/products', [CustomerController::class, 'products'])->name('products'); // Daftar Produk
//     Route::get('/product-show', [CustomerController::class, 'showProduct'])->name('customer.product-show'); // Daftar Produk
    
//     // Bagian keranjang
//     Route::post('/cart/add', [CustomerController::class, 'addToCart'])->name('cart.add'); // Menambahkan produk ke keranjang
//     Route::get('/cart', [CustomerController::class, 'viewCart'])->name('cart.view'); // Menampilkan keranjang belanja
//     Route::delete('/cart/remove/{id}', [CustomerController::class, 'removeFromCart'])->name('cart.remove'); // Menghapus produk dari keranjang

//     // Bagian order
//     Route::post('/orders', [CustomerController::class, 'createOrder'])->name('orders.store'); // Membuat Pesanan
//     Route::get('/orders', [CustomerController::class, 'orders'])->name('orders'); // Menampilkan Pesanan

//     // Bagian checkout
//     Route::get('/checkout', [CustomerController::class, 'checkout'])->name('checkout.index'); // Halaman Checkout
//     Route::get('/orders/{id}', [CustomerController::class, 'showOrder'])->name('orders.show');
//     Route::post('/checkout/process', [CustomerController::class, 'processCheckout'])->name('checkout.process'); // Memproses Checkout
//     Route::get('/checkout/success', [CustomerController::class, 'checkoutSuccess'])->name('checkout.success'); // Halaman Sukses Checkout

//     // Bagian profil
//     Route::get('/profile', [CustomerController::class, 'profile'])->name('profile'); // Halaman Profil
//     Route::get('/profile/edit', [CustomerController::class, 'editProfile'])->name('profile.edit'); // Halaman Edit Profil
//     Route::put('/profile/update', [CustomerController::class, 'updateProfile'])->name('profile.update'); // Memperbarui Profil
// });

// Route::prefix('customer')->name('customer.')->middleware('role:customer')->group(function () {
//     Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
//     Route::get('/products', [CustomerController::class, 'products'])->name('customer.products');
//     Route::get('/products/{id}', [CustomerController::class, 'showProduct'])->name('customer.products.show');
//     Route::post('/cart/add', [CustomerController::class, 'addToCart'])->name('cart.add');
//     Route::get('/cart', [CustomerController::class, 'viewCart'])->name('cart.view');
//     Route::delete('/cart/remove/{id}', [CustomerController::class, 'removeFromCart'])->name('cart.remove');
//     Route::get('/orders', [CustomerController::class, 'orders'])->name('customer.orders');
//     Route::get('/checkout', [CustomerController::class, 'checkout'])->name('customer.checkout.index');
//     Route::post('/checkout', [CustomerController::class, 'processCheckout'])->name('customer.checkout.process');
//     Route::get('/checkout/success', [CustomerController::class, 'checkoutSuccess'])->name('customer.checkout.success');
//     Route::get('/profile', [CustomerController::class, 'profile'])->name('customer.profile');
//     Route::get('/profile/edit', [CustomerController::class, 'editProfile'])->name('customer.profile.edit');
//     Route::put('/profile', [CustomerController::class, 'updateProfile'])->name('customer.profile.update');
// });
//Halaman tanpa autentikasi
// Route::get('/', function () {
//     return view('home');
// })->name('home');