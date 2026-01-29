@extends('master_nav')

@section('title', 'Medi-Go - Login')

@section('styles')
<style>
    .login-section {
        min-height: 100vh;
        background: radial-gradient(circle at top right, #d1fae5 0%, #ffffff 50%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-card {
        background: white;
        border-radius: 25px;
        padding: 40px;
        max-width: 420px;
        width: 100%;
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        animation: fadeIn 0.8s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .login-title {
        font-weight: 800;
        margin-bottom: 10px;
    }

    .login-input {
        border-radius: 12px;
        padding: 12px 45px 12px 15px;
        transition: 0.3s;
    }

    .login-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(16,185,129,0.15);
    }

    .input-icon {
        position: absolute;
        right: 15px;
        top: 38px;
        color: #999;
        cursor: pointer;
    }

    .login-btn {
        width: 100%;
        background: var(--primary);
        color: white;
        padding: 12px;
        border-radius: 50px;
        font-weight: 700;
        border: none;
        transition: 0.3s;
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

    .google-btn {
        width: 100%;
        border-radius: 50px;
        padding: 12px;
        font-weight: 700;
        border: 1px solid #ddd;
        transition: 0.3s;
    }

    .google-btn:hover {
        background: #f8fafc;
    }

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
        0% { box-shadow: 0 0 0 0 rgba(16,185,129,0.4); }
        70% { box-shadow: 0 0 0 15px rgba(16,185,129,0); }
        100% { box-shadow: 0 0 0 0 rgba(16,185,129,0); }
    }
</style>
@endsection

@section('content')
<section class="login-section">
    <div class="login-card text-center">

        <div class="login-icon">
            <i class="fas fa-user-shield"></i>
        </div>

        <h3 class="login-title">Welcome Back</h3>
        <p class="text-muted mb-4">Login to your Medi-Go account</p>

        {{-- Error Message --}}
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" onsubmit="showLoading()">
            @csrf

            <div class="mb-3 text-start position-relative">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email" class="form-control login-input" placeholder="Enter your email" required>
                <i class="fas fa-envelope input-icon"></i>
            </div>

            <div class="mb-3 text-start position-relative">
                <label class="form-label fw-bold">Password</label>
                <input type="password" name="password" id="password" class="form-control login-input" placeholder="Enter your password" required>
                <i class="fas fa-eye input-icon" onclick="togglePassword()"></i>
            </div>

            <div class="d-flex justify-content-between mb-3">
                <div>
                    <input type="checkbox"> Remember me
                </div>
                <a href="#" class="text-success fw-bold text-decoration-none">Forgot?</a>
            </div>

            <button type="submit" id="loginBtn" class="login-btn mb-3">
                <i class="fas fa-sign-in-alt me-2"></i> Login
            </button>
        </form>

        <button class="google-btn">
            <i class="fab fa-google me-2 text-danger"></i> Login with Google
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
</script>
@endsection
