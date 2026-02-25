@extends('master_nav')

@section('title', 'Medi-Go - Sign Up')

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
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
    }

    .register-title {
        font-weight: 800;
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
    }
</style>
@endsection


@section('content')

<section class="register-section">

    <div class="register-card">

        <h3 class="register-title text-center">
            Create Your Medi-Go Account
        </h3>

        <p class="text-muted text-center mb-4">
            Fast, secure & trusted medicine delivery
        </p>


        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif


        {{-- VALIDATION ERRORS --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif



        <form action="{{ route('register.store') }}" method="POST">

            @csrf


            {{-- NAME --}}
            <input type="text"
                name="name"
                class="form-control register-input mb-3"
                placeholder="Full Name"
                value="{{ old('name') }}"
                required>



            {{-- BIRTH DATE --}}
            <input type="date"
                name="birth_date"
                class="form-control register-input mb-3"
                value="{{ old('birth_date') }}"
                required>



            {{-- EMAIL --}}
            <input type="email"
                name="email"
                class="form-control register-input mb-3"
                placeholder="Email Address"
                value="{{ old('email') }}"
                required>



            <div class="row">

                <div class="col-md-6 mb-3">

                    <input type="password"
                        name="password"
                        class="form-control register-input"
                        placeholder="Password"
                        required>

                </div>


                <div class="col-md-6 mb-3">

                    <input type="password"
                        name="password_confirmation"
                        class="form-control register-input"
                        placeholder="Confirm Password"
                        required>

                </div>

            </div>


            <hr>


            {{-- ADDRESS --}}
            <input type="text"
                name="address"
                class="form-control register-input mb-3"
                placeholder="Address"
                value="{{ old('address') }}"
                required>



            <div class="row">

                <div class="col-md-4 mb-3">

                    <input type="text"
                        name="city"
                        class="form-control register-input"
                        placeholder="City"
                        value="{{ old('city') }}"
                        required>

                </div>


                <div class="col-md-4 mb-3">

                    <input type="text"
                        name="state"
                        class="form-control register-input"
                        placeholder="State"
                        value="{{ old('state') }}"
                        required>

                </div>


                <div class="col-md-4 mb-3">

                    <input type="text"
                        name="pincode"
                        class="form-control register-input"
                        placeholder="Pincode"
                        value="{{ old('pincode') }}"
                        required>

                </div>

            </div>



            <button type="submit" class="register-btn mt-2">

                <i class="fas fa-user-plus me-2"></i>
                Create Account

            </button>


        </form>



        <p class="text-center mt-4">

            Already have an account?

            <a href="{{ route('login') }}"
                class="fw-bold text-success text-decoration-none">

                Login

            </a>

        </p>

    </div>

</section>

@endsection