@extends('master_nav')

@section('title', 'MediSwift - Sign Up')

@section('styles')
<style>
    .register-section {
        min-height: 100vh;
        background: radial-gradient(circle at top right, #d1fae5 0%, #ffffff 50%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 60px 15px;
    }

    .register-card {
        background: white;
        border-radius: 25px;
        padding: 40px;
        max-width: 520px;
        width: 100%;
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
    }

    .register-title {
        font-weight: 800;
        margin-bottom: 5px;
    }

    .register-input {
        border-radius: 12px;
        padding: 12px 15px;
    }

    .register-btn {
        width: 100%;
        background: var(--primary);
        color: white;
        padding: 14px;
        border-radius: 50px;
        font-weight: 700;
        border: none;
        transition: 0.3s;
    }

    .register-btn:hover {
        background: #047857;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(5,150,105,0.3);
    }
</style>
@endsection

@section('content')
<section class="register-section">
<div class="register-card">

    <h3 class="register-title text-center">Create Your MediSwift Account</h3>
    <p class="text-muted text-center mb-4">Fast, secure & trusted medicine delivery</p>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <!-- Basic Info -->
        <input type="text" name="name" class="form-control register-input mb-3" placeholder="Full Name" required>
        <input type="date" name="Birth Date" class="form-control register-input mb-3" placeholder="Birth Date" required>
        <input type="email" name="email" class="form-control register-input mb-3" placeholder="Email Address" required>

        <div class="row">
            <div class="col-md-6 mb-3">
                <input type="password" name="password" class="form-control register-input" placeholder="Password" required>
            </div>
            <div class="col-md-6 mb-3">
                <input type="password" name="password_confirmation" class="form-control register-input" placeholder="Confirm Password" required>
            </div>
        </div>

        <hr>

        <!-- Address Info -->
        <input type="text" name="address" class="form-control register-input mb-3" placeholder="Address Line" required>

        <div class="row">
            <div class="col-md-4 mb-3">
                <input type="text" name="city" class="form-control register-input" placeholder="City" required>
            </div>
            <div class="col-md-4 mb-3">
                <input type="text" name="state" class="form-control register-input" placeholder="State" required>
            </div>
            <div class="col-md-4 mb-3">
                <input type="text" name="pincode" class="form-control register-input" placeholder="Pincode" required>
            </div>
        </div>

        <button type="submit" class="register-btn mt-2">
            <i class="fas fa-user-plus me-2"></i> Create Account
        </button>
    </form>

    <p class="text-center mt-4">
        Already have an account?
        <a href="{{ route('login') }}" class="fw-bold text-success text-decoration-none">Login</a>
    </p>

</div>
</section>
@endsection
