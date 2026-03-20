@extends('master_nav')

@section('title', 'Verify OTP - Medi-Go')

@section('styles')
<style>
    :root {
        --primary: #059669;
        --primary-dark: #047857;
        --success: #10b981;
    }

    .auth-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 50%, #6ee7b7 100%);
        padding: 40px 20px;
        position: relative;
        overflow: hidden;
    }

    .auth-wrapper::before {
        content: '';
        position: absolute;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: -100px;
        left: -100px;
        animation: float 6s ease-in-out infinite;
    }

    .auth-wrapper::after {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
        bottom: -50px;
        right: -50px;
        animation: float 8s ease-in-out infinite reverse;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(30px); }
    }

    .auth-card {
        background: white;
        border-radius: 30px;
        padding: 50px 40px;
        width: 100%;
        max-width: 450px;
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.12);
        position: relative;
        z-index: 1;
        animation: slideUp 0.6s ease;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .icon-wrapper {
        width: 90px;
        height: 90px;
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        margin: 0 auto 25px;
        box-shadow: 0 15px 35px rgba(5, 150, 105, 0.2);
        animation: bounce 2s ease-in-out infinite;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .auth-card h3 {
        font-weight: 800;
        font-size: 1.8rem;
        color: #1f2937;
        margin-bottom: 10px;
        text-align: center;
    }

    .auth-card .subtitle {
        text-align: center;
        color: #6b7280;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 30px;
    }

    .email-display {
        background: #f0fdf4;
        border: 2px solid #d1fae5;
        padding: 12px 16px;
        border-radius: 12px;
        text-align: center;
        margin-bottom: 25px;
        font-weight: 600;
        color: var(--primary);
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        font-weight: 700;
        font-size: 0.85rem;
        color: #374151;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 10px;
        display: block;
    }

    .form-control {
        padding: 14px 18px;
        border-radius: 14px;
        border: 2px solid #e5e7eb;
        background-color: #f9fafb;
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        color: #1f2937;
        text-align: center;
        letter-spacing: 2px;
        font-size: 1.2rem;
    }

    .form-control:focus {
        background-color: white;
        border-color: var(--primary);
        box-shadow: 0 0 0 5px rgba(5, 150, 105, 0.1);
        outline: none;
    }

    .form-control::placeholder {
        color: #9ca3af;
        letter-spacing: 0;
    }

    .form-control.is-invalid {
        border-color: #ef4444;
        background-color: #fef2f2;
    }

    .invalid-feedback {
        color: #ef4444;
        font-size: 0.85rem;
        margin-top: 6px;
        display: block;
    }

    .alert {
        border-radius: 14px;
        border: none;
        padding: 15px 18px;
        margin-bottom: 25px;
        font-size: 0.9rem;
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert-danger {
        background-color: #fef2f2;
        color: #991b1b;
        border-left: 4px solid #ef4444;
    }

    .btn-submit {
        width: 100%;
        padding: 14px 20px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--success) 100%);
        color: white;
        border: none;
        border-radius: 14px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 10px 25px rgba(5, 150, 105, 0.3);
        margin-top: 10px;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(5, 150, 105, 0.4);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    .divider {
        border-top: 2px solid #e5e7eb;
        margin: 30px 0;
    }

    .footer-link {
        text-align: center;
        margin-top: 20px;
    }

    .footer-link a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .footer-link a:hover {
        color: var(--primary-dark);
        transform: translateX(-3px);
    }

    .info-box {
        background: #f0fdf4;
        border-left: 4px solid var(--primary);
        padding: 12px 15px;
        border-radius: 8px;
        font-size: 0.85rem;
        color: #166534;
        margin-bottom: 20px;
    }

    .info-box i {
        margin-right: 8px;
        color: var(--primary);
    }
</style>
@endsection

@section('content')

<div class="auth-wrapper">
    <div class="auth-card">
        
        <div class="text-center mb-4">
            <div class="icon-wrapper">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h3>Verify OTP</h3>
            <p class="subtitle">
                Enter the 6-digit code we sent to your email
            </p>
        </div>

        <div class="email-display">
            <i class="fas fa-envelope me-2"></i>{{ session('email') ?? 'your email' }}
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-exclamation-circle me-2"></i>Error!</strong>
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="info-box">
            <i class="fas fa-clock"></i>
            OTP expires in 10 minutes
        </div>

        <form action="{{ route('forgot.verify') }}" method="POST">
            @csrf
            <input type="hidden" name="email" value="{{ session('email') }}">
            
            <div class="form-group">
                <label class="form-label">Enter OTP Code</label>
                <input type="text" name="otp" class="form-control @error('otp') is-invalid @enderror" 
                    placeholder="000000" maxlength="6" pattern="[0-9]{6}" required autofocus>
                @error('otp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-check me-2"></i>Verify & Proceed
            </button>

        </form>

        <div class="divider"></div>

        <div class="footer-link">
            <a href="{{ route('forgot.form') }}">
                <i class="fas fa-arrow-left"></i> Back to Email
            </a>
        </div>

    </div>
</div>

@endsection
