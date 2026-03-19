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
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleController;


Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('auth.google.callback');

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

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::put('/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/products/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');

    Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::put('/categories/{id}', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
    Route::patch('/categories/{id}/toggle-status', [AdminController::class, 'toggleCategoryStatus'])->name('admin.categories.toggle-status');
    Route::delete('/categories/{id}', [AdminController::class, 'deleteCategory'])->name('admin.categories.delete');

    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::put('/orders/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.status');

    Route::get('/ratings', [AdminController::class, 'ratings'])->name('admin.ratings');
    Route::delete('/ratings/{id}', [AdminController::class, 'deleteRating'])->name('admin.ratings.delete');

    Route::get('/contact', [AdminController::class, 'contact'])->name('admin.contact');
    Route::delete('/contact/{id}', [AdminController::class, 'deleteContact'])->name('admin.contact.delete');

    Route::get('/cart', [AdminController::class, 'cart'])->name('admin.cart');
    Route::get('/wishlist', [AdminController::class, 'wishlist'])->name('admin.wishlist');

    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::put('/profile/update', [AdminController::class, 'profileUpdate'])->name('admin.profile.update');
    Route::put('/profile/password', [AdminController::class, 'profilePassword'])->name('admin.profile.password');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Http\Request $request, $id, $hash) {
    $user = \App\Models\Register::findOrFail($id);

    // validate the hash
    if (! hash_equals(sha1($user->getEmailForVerification()), (string) $hash)) {
        abort(403, 'Invalid verification link.');
    }

    // validate the signature
    if (! $request->hasValidSignature()) {
        abort(403, 'Verification link expired or invalid.');
    }

    if (! $user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
    }

    $user->status = 'active';
    $user->save();

    return redirect()->route('login')->with('success', 'Email verified! Your account is now active. Please login.');
})->middleware('signed')->name('verification.verify');
