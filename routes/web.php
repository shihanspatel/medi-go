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

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

