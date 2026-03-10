<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Guest;
use App\Http\Controllers\orderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\normal_controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Mail;

Route::get('/', [Guest::class, 'index'])->name('home.index');
Route::get('/products/search', [guest::class, 'search'])->name('products.search');
Route::get('/category/{slug}', [Guest::class, 'show'])->name('category.show');
Route::get('/product/{id}', [Guest::class, 'product_show'])->name('product.show');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact-us', [Guest::class, 'contact_index'])->name('contact');
Route::post('/contact-us', [Guest::class, 'store'])->name('contact.store');

Route::middleware('guest')->group(function () {
    Route::get('/login', [normal_controller::class, 'login_index'])->name('login');
    Route::post('/login', [normal_controller::class, 'login_check'])->name('login.check');
    Route::get('/register', [normal_controller::class, 'create'])->name('register');
    Route::post('/register', [normal_controller::class, 'store'])->name('register.store');
    Route::view('/forgot', 'forgot_password_form');
    Route::view('/otp', 'forgot_password_otp_page');
    Route::view('/reset-pass', 'forgot_password_set_new_pass');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', [Guest::class, 'index'])->name('home');
    Route::view('/order-history', 'after_login_user_orders');
    Route::view('/cart', 'cart');
    Route::view('/wishlist', 'wishlist');

    Route::get('/profile', [normal_controller::class, 'Profile_index'])->name('profile');
    Route::put('/profile/update', [normal_controller::class, 'Profile_update'])->name('profile.update');
    Route::post('/profile/upload-photo', [AuthController::class, 'uploadPhoto'])->name('profile.upload-photo');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/wishlist', [CartController::class, 'wishlist_index'])->name('wishlist.index');
    Route::post('/wishlist/add', [CartController::class, 'wishlist_add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{id}', [CartController::class, 'wishlist_remove'])->name('wishlist.remove');

    Route::post('/checkout', [orderController::class, 'checkout'])->name('checkout');
    Route::get('/payment/checkout/{order_id}', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::post('/payment/verify', [PaymentController::class, 'verify'])->name('payment.verify');
    Route::get('/orders', [orderController::class, 'index'])->name('orders.index');

    Route::post('/rating/store', [RatingController::class, 'store'])->name('rating.store');
});

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

Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        $user = $request->user();
        $user->status = 'active';
        $user->save();
        return redirect()->route('login')->with('success', 'Email verified & account activated successfully!');
    })->middleware(['signed'])->name('verification.verify');
});
