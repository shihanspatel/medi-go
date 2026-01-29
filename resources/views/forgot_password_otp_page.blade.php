@extends('master_nav')

@section('title', 'Verify OTP - Medi-Go')

@section('styles')
<style>
    /* --- Page Specific Styles --- */
    
    .auth-wrapper {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: radial-gradient(circle at top left, #f8fafc 0%, #ffffff 100%);
        padding: 40px 20px;
    }

    .auth-card {
        background: white;
        border: 1px solid #f1f5f9;
        border-radius: 24px;
        padding: 40px;
        width: 100%;
        max-width: 400px; /* Slightly narrower for OTP */
        box-shadow: 0 20px 50px rgba(0,0,0,0.05);
        position: relative;
        overflow: hidden;
        text-align: center;
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

    /* --- SCOPED OTP INPUTS --- */
    .otp-container {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin: 30px 0;
    }

    .auth-card .otp-input {
        width: 55px;
        height: 55px;
        border-radius: 12px;
        border: 2px solid #e2e8f0;
        background-color: #fcfcfc;
        text-align: center;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark);
        transition: 0.2s;
    }

    .auth-card .otp-input:focus {
        border-color: var(--primary);
        background-color: white;
        box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.1);
        outline: none;
        transform: translateY(-2px);
    }

    /* Resend Link */
    .resend-link {
        color: var(--primary);
        text-decoration: none;
        font-weight: 700;
        font-size: 0.9rem;
    }
    .resend-link:hover { text-decoration: underline; }
    
    .timer { color: #94a3b8; font-size: 0.85rem; font-weight: 500; }

</style>
@endsection

@section('content')

<div class="auth-wrapper">
    <div class="auth-card" data-aos="zoom-in" data-aos-duration="600">
        
        <div class="icon-wrapper">
            <i class="fas fa-shield-alt"></i>
        </div>
        <h3 class="fw-bold text-dark mb-2">Verify OTP</h3>
        <p class="text-secondary small mb-0 px-3" style="line-height: 1.5;">
            We sent a 4-digit code to <br><strong>john@example.com</strong>
        </p>

        <form action="#">
            
            <div class="otp-container">
                <input type="text" class="otp-input" maxlength="1" autofocus oninput="this.value=this.value.replace(/[^0-9]/g,''); if(this.value.length >= this.maxLength) this.nextElementSibling.focus()">
                <input type="text" class="otp-input" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,''); if(this.value.length >= this.maxLength) this.nextElementSibling.focus()">
                <input type="text" class="otp-input" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,''); if(this.value.length >= this.maxLength) this.nextElementSibling.focus()">
                <input type="text" class="otp-input" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
            </div>

            <button type="button" class="btn btn-success w-100 py-3 rounded-pill fw-bold shadow-sm mb-4" style="font-size: 1rem;">
                Verify & Proceed
            </button>

        </form>

        <div class="border-top border-light pt-4">
            <p class="timer mb-2">Code expires in 00:59</p>
            <p class="small text-muted m-0">
                Didn't receive code? <a href="#" class="resend-link">Resend OTP</a>
            </p>
        </div>

    </div>
</div>

@endsection