<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Guest;
use App\Http\Controllers\orderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\normal_controller;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Accessible to Everyone)
|--------------------------------------------------------------------------
*/

Route::get('/', [Guest::class, 'index'])->name('home.index');

Route::get('/category/{slug}', [Guest::class, 'show'])
    ->name('category.show');

Route::get('/product/{id}', [Guest::class, 'product_show'])
    ->name('product.show');

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/contact-us', [Guest::class, 'contact_index'])->name('contact');
Route::post('/contact-us', [Guest::class, 'store'])->name('contact.store');


/*
|--------------------------------------------------------------------------
| GUEST ONLY ROUTES (Not Logged In)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [normal_controller::class, 'login_index'])
        ->name('login');

    Route::post('/login', [normal_controller::class, 'login_check'])
        ->name('login.check');

    Route::get('/register', [normal_controller::class, 'create'])
        ->name('register');

    Route::post('/register', [normal_controller::class, 'store'])
        ->name('register.store');

    Route::view('/forgot', 'forgot_password_form');
    Route::view('/otp', 'forgot_password_otp_page');
    Route::view('/reset-pass', 'forgot_password_set_new_pass');
});

Route::middleware('auth')->group(function () {

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
});
/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Logged In Users Only)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/home', [Guest::class, 'index'])
        ->name('home');

    Route::view('/order-history', 'after_login_user_orders');
    Route::view('/cart', 'cart');
    Route::view('/wishlist', 'wishlist');

    Route::get('/profile', [normal_controller::class, 'Profile_index'])
        ->name('profile');

    Route::post('/profile/update', [normal_controller::class, 'Profile_update'])
        ->name('profile.update');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post(
        '/cart/add',
        [CartController::class, 'add']
    )
        ->name('cart.add')
        ->middleware('auth');

    Route::get(
        '/wishlist',
        [CartController::class, 'wishlist_index']
    )
        ->name('wishlist.index');

    Route::post(
        '/wishlist/add',
        [CartController::class, 'wishlist_add']
    )
        ->name('wishlist.add');

    Route::delete(
        '/wishlist/remove/{id}',
        [CartController::class, 'wishlist_remove']
    )
        ->name('wishlist.remove');

    Route::post(
        '/checkout',
        [OrderController::class, 'checkout']
    )
        ->name('checkout')
        ->middleware('auth');

    Route::get(
        '/orders',
        [OrderController::class, 'index']
    )
        ->name('orders.index')
        ->middleware('auth');
});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware('auth')->group(function () {

    Route::view('/dashboard', 'admin.Admin_dashboard');
    Route::view('/users', 'admin.admin_User');
    Route::view('/categories', 'admin.admin_categories');
    Route::view('/products', 'admin.admin_products');
    Route::view('/orders', 'admin.Admin_orders');
    Route::view('/ratings', 'admin.Admin_ratings');
    Route::view('/contact', 'admin.Admin_contact');
    Route::view('/cart', 'admin.Admin_cart');
    Route::view('/wishlist', 'admin.admin_wishlist');
    Route::view('/profile', 'admin.admin_profile');
});
