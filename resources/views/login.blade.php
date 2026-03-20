@extends('master_nav')

@section('title', 'Medi-Go - Login')

@section('styles')
<style>
    :root {
        --primary: #059669;
        --primary-dark: #047857;
    }

    /* LOGIN SECTION */

    .login-section {
        min-height: 100vh;
        background: radial-gradient(circle at top right, #d1fae5 0%, #ffffff 50%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 15px;
    }

    /* LOGIN CARD */

    .login-card {
        background: white;
        border-radius: 25px;
        padding: 40px;
        max-width: 420px;
        width: 100%;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        animation: fadeIn .8s ease;
    }

    @keyframes fadeIn {

        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }

    }

    /* ICON */

    .login-icon {
        width: 80px;
        height: 80px;
        background: #ecfdf5;
        color: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin: 0 auto 20px;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {

        0% {
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4);
        }

        70% {
            box-shadow: 0 0 0 15px rgba(16, 185, 129, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
        }

    }

    /* TITLE */

    .login-title {
        font-weight: 800;
        margin-bottom: 5px;
    }

    /* INPUT */

    .login-input {
        border-radius: 12px;
        padding: 12px 45px 12px 15px;
        transition: .3s;
    }

    .login-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
    }

    /* INPUT ICON */

    .input-icon {
        position: absolute;
        right: 15px;
        top: 40px;
        color: #999;
        cursor: pointer;
    }

    /* BUTTON */

    .login-btn {
        width: 100%;
        background: var(--primary);
        color: white;
        padding: 12px;
        border-radius: 50px;
        font-weight: 700;
        border: none;
        transition: .3s;
    }

    .login-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(5, 150, 105, 0.3);
    }

    .login-btn.loading {
        pointer-events: none;
        background: #9ca3af;
    }

    /* GOOGLE BUTTON */

    .google-btn {
        width: 100%;
        border-radius: 50px;
        padding: 12px;
        font-weight: 700;
        border: 1px solid #ddd;
        transition: .3s;
        background: white;
    }

    .google-btn:hover {
        background: #f8fafc;
    }

    /* INPUT VALIDATION */

    .login-input.is-invalid {
        border-color: #ef4444 !important;
        background-color: #fef2f2;
    }

    .invalid-feedback {
        color: #ef4444;
        font-size: 0.85rem;
        margin-top: 6px;
        display: block;
    }

    /* TOAST NOTIFICATIONS */

    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .toast {
        background: white;
        border-radius: 12px;
        padding: 16px 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 320px;
        animation: slideInRight 0.4s ease;
        border-left: 4px solid;
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(400px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideOutRight {
        from {
            opacity: 1;
            transform: translateX(0);
        }
        to {
            opacity: 0;
            transform: translateX(400px);
        }
    }

    .toast.hide {
        animation: slideOutRight 0.4s ease forwards;
    }

    .toast-icon {
        font-size: 1.3rem;
        flex-shrink: 0;
    }

    .toast-content {
        flex: 1;
    }

    .toast-title {
        font-weight: 700;
        font-size: 0.95rem;
        margin-bottom: 2px;
    }

    .toast-message {
        font-size: 0.85rem;
        opacity: 0.9;
    }

    .toast-close {
        background: none;
        border: none;
        font-size: 1.2rem;
        cursor: pointer;
        opacity: 0.6;
        transition: opacity 0.3s ease;
        flex-shrink: 0;
    }

    .toast-close:hover {
        opacity: 1;
    }

    .toast-success {
        border-left-color: #10b981;
        color: #166534;
    }

    .toast-success .toast-icon {
        color: #10b981;
    }

    .toast-error {
        border-left-color: #ef4444;
        color: #991b1b;
    }

    .toast-error .toast-icon {
        color: #ef4444;
    }

    .toast-warning {
        border-left-color: #f59e0b;
        color: #92400e;
    }

    .toast-warning .toast-icon {
        color: #f59e0b;
    }

    .toast-info {
        border-left-color: #3b82f6;
        color: #1e40af;
    }

    .toast-info .toast-icon {
        color: #3b82f6;
    }

    @media (max-width: 480px) {
        .toast-container {
            left: 10px;
            right: 10px;
            top: 10px;
        }

        .toast {
            min-width: auto;
        }
    }
</style>
@endsection


@section('content')

<div class="toast-container" id="toastContainer"></div>

<section class="login-section">

    <div class="login-card text-center">

        <div class="login-icon">
            <i class="fas fa-user-shield"></i>
        </div>

        <h3 class="login-title">
            Welcome Back
        </h3>

        <p class="text-muted mb-4">
            Login to your Medi-Go account
        </p>

        <form action="{{ route('login') }}" method="POST" onsubmit="showLoading()">

            @csrf

            <div class="mb-3 text-start position-relative">

                <label class="form-label fw-bold">
                    Email
                </label>

                <input type="email"
                    name="email"
                    class="form-control login-input @error('email') is-invalid @enderror"
                    placeholder="Enter your email"
                    value="{{ old('email') }}"
                    required>

                <i class="fas fa-envelope input-icon"></i>

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>


            <div class="mb-3 text-start position-relative">

                <label class="form-label fw-bold">
                    Password
                </label>

                <input type="password"
                    name="password"
                    id="password"
                    class="form-control login-input @error('password') is-invalid @enderror"
                    placeholder="Enter your password"
                    required>

                <i class="fas fa-eye input-icon"
                    onclick="togglePassword()"></i>

                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>


            <div class="d-flex justify-content-between mb-3">

                <label class="small">
                    <input type="checkbox"> Remember me
                </label>

                <a href="{{ route('forgot.form') }}"
                    class="text-success fw-bold text-decoration-none">
                    Forgot?
                </a>

            </div>

            <div class="d-flex justify-content-center my-3">
                <x-turnstile-widget
                    theme="dark"
                    language="en-US"
                    size="normal"
                    callback="callbackFunction"
                    errorCallback="errorCallbackFunction" />
            </div>

            <button type="submit"
                id="loginBtn"
                class="login-btn mb-3">

                <i class="fas fa-sign-in-alt me-2"></i>
                Login

            </button>
            
        </form>


        <button class="google-btn" type="button">
            <a href="{{ route('auth.google') }}" style="text-decoration: none; color:black;">
                <i class="fab fa-google me-2 text-danger"></i>
                Login with Google
            </a>
        </button>

    </div>

</section>


<script>
    function togglePassword() {
        let pass = document.getElementById("password");
        pass.type = pass.type === "password" ? "text" : "password";
    }

    function showLoading() {
        let btn = document.getElementById("loginBtn");
        btn.classList.add("loading");
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Logging in...';
    }

    function showToast(type, title, message, duration = 4000) {
        const container = document.getElementById('toastContainer');
        const toastId = 'toast-' + Date.now();
        
        const toast = document.createElement('div');
        toast.id = toastId;
        toast.className = `toast toast-${type}`;
        
        const icons = {
            success: 'fas fa-check-circle',
            error: 'fas fa-exclamation-circle',
            warning: 'fas fa-exclamation-triangle',
            info: 'fas fa-info-circle'
        };
        
        toast.innerHTML = `
            <i class="toast-icon ${icons[type]}"></i>
            <div class="toast-content">
                <div class="toast-title">${title}</div>
                <div class="toast-message">${message}</div>
            </div>
            <button class="toast-close" onclick="closeToast('${toastId}')">
                <i class="fas fa-times"></i>
            </button>
        `;
        
        container.appendChild(toast);
        
        setTimeout(() => {
            closeToast(toastId);
        }, duration);
    }

    function closeToast(toastId) {
        const toast = document.getElementById(toastId);
        if (toast) {
            toast.classList.add('hide');
            setTimeout(() => {
                toast.remove();
            }, 400);
        }
    }

    // Show toasts from session messages
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
            showToast('success', 'Success!', '{{ session('success') }}');
        @endif

        @if(session('error'))
            showToast('error', 'Error!', '{{ session('error') }}');
        @endif

        @if(session('warning'))
            showToast('warning', 'Notice!', '{{ session('warning') }}');
        @endif

        @if($errors->any())
            @foreach($errors->all() as $error)
                showToast('error', 'Validation Error!', '{{ $error }}');
            @endforeach
        @endif
    });
</script>

@endsection
