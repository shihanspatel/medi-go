<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about_us');
});

Route::get('/medicines', function () {
    return view('medicines');
});

Route::get('/baby_care', function () {
    return view('baby_care');
});

Route::get('/nutration', function () {
    return view('nutration');
});

Route::get('/devices', function () {
    return view('devices');
});

Route::get('/view_product_', function () {
    return view('before_login_prodct');
});

Route::get('contact-us',function(){
    return view('contact_us');
});

Route::get('/forgot', function () {
    return view('forgot_password_form');
});

Route::get('/otp', function () {
    return view('forgot_password_otp_page');
});

Route::get('/reset-pass', function () {
    return view('forgot_password_set_new_pass');
});

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin/dashboard', function () {
    return view('admin.Admin_dashboard');
});

Route::get('/admin/users', function () {
    return view('admin.admin_User');
});

Route::get('/admin/categories', function () {
    return view('admin.admin_categories');
});

Route::get('/admin/products', function () {
    return view('admin.admin_products');
});

Route::get('/admin/orders', function () {
    return view('admin.Admin_orders');
});

Route::get('/admin/ratings', function () {
    return view('admin.Admin_ratings');
});

Route::get('/admin/contact', function () {
    return view('admin.Admin_contact');
});

Route::get('/admin/cart', function () {
    return view('admin.Admin_cart');
});

Route::get('/admin/wishlist', function () {
    return view('admin.admin_wishlist');
});

Route::get('/admin/profile', function () {
    return view('admin.admin_profile');
});


//=========================================================================
//====================this is after login user's routes====================


Route::get('/home', function () {
    return view('after_login_home_page');
});

Route::get('/About', function () {
    return view('after_login_about_us');
});

Route::get('/contact', function () {
    return view('after_login_contact_use');
});

Route::get('/profile', function () {
    return view('after_login_user_profile');
});

Route::get('/order-history', function () {
    return view('after_login_user_orders');
});

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/wishlist', function () {
    return view('wishlist');
});

Route::get('/view_product', function () {
    return view('view_prod');
});

Route::get('/medicines_', function () {
    return view('after_login_med');
});

Route::get('/baby_care_', function () {
    return view('after_login_baby');
});

Route::get('/nutration_', function () {
    return view('after_login_nutration');
});

Route::get('/devices_', function () {
    return view('after_login_device');
});