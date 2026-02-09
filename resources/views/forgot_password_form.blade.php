@extends('master_nav')

@section('title', 'Forgot Password - Medi-Go')

@section('styles')
<style>
    /* --- Page Specific Styles --- */
    
    /* Centered Wrapper */
    .auth-wrapper {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: radial-gradient(circle at top left, #f8fafc 0%, #ffffff 100%);
        padding: 40px 20px;
    }

    /* Auth Card */
    .auth-card {
        background: white;
        border: 1px solid #f1f5f9;
        border-radius: 24px;
        padding: 40px;
        width: 100%;
        max-width: 420px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.05);
        position: relative;
        overflow: hidden;
    }

    /* Decorative Elements */
    .auth-card::before {
        content: '';
        position: absolute;
        top: -30px;
        right: -30px;
        width: 100px;
        height: 100px;
        background: var(--primary);
        opacity: 0.05;
        border-radius: 50%;
    }
    
    /* Icon Box */
    .icon-wrapper {
        width: 70px;
        height: 70px;
        background: #ecfdf5;
        color: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin: 0 auto 20px;
        box-shadow: 0 10px 20px rgba(5, 150, 105, 0.1);
    }

    /* --- SCOPED INPUT STYLING (Fixes Navbar Issue) --- */
    /* Only targets labels/inputs INSIDE the auth card */
    
    .auth-card .form-label {
        font-weight: 700;
        font-size: 0.8rem;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }
    
    .auth-card .form-control {
        padding: 12px 18px;
        border-radius: 12px;
        border: 2px solid #f1f5f9;
        background-color: #fcfcfc;
        font-weight: 500;
        transition: 0.2s;
        font-size: 0.95rem;
    }
    
    .auth-card .form-control:focus {
        background-color: white;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.1);
    }

    /* Back Link */
    .back-link {
        text-decoration: none;
        color: #94a3b8;
        font-weight: 600;
        font-size: 0.9rem;
        transition: 0.2s;
        display: inline-flex;
        align-items: center;
    }
    .back-link:hover {
        color: var(--dark);
        transform: translateX(-3px);
    }
</style>
@endsection

@section('content')

<div class="auth-wrapper">
    <div class="auth-card" data-aos="zoom-in" data-aos-duration="600">
        
        <div class="text-center mb-4">
            <div class="icon-wrapper">
                <i class="fas fa-lock-open"></i>
            </div>
            <h3 class="fw-bold text-dark mb-2">Forgot Password?</h3>
            <p class="text-secondary small mb-0" style="line-height: 1.5;">
                Don't worry, it happens! Enter your email below and we will send you reset instructions.
            </p>
        </div>

        <form action="#"> 

            <div class="mb-4">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-control" placeholder="john@example.com">
            </div>

            <button type="button" class="btn btn-success w-100 py-3 rounded-pill fw-bold shadow-sm mb-4" style="font-size: 1rem;">
                Send Reset Link <i class="fas fa-paper-plane ms-2"></i>
            </button>

        </form>

        <div class="text-center border-top border-light pt-4">
            <a href="{{ url('/login') }}" class="back-link">
                <i class="fas fa-arrow-left me-2"></i> Back to Login
            </a>
        </div>

    </div>
</div>

@endsection