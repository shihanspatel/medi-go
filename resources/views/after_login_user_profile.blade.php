@extends('master_nav')

@section('title','My Profile - Medi-Go')

@section('styles')
<style>
    :root {
        --primary: #059669;
        --primary-dark: #047857;
    }

    body {
        background: #f8fafc;
    }

    /* HEADER */
    .profile-header-bg {
        background: linear-gradient(135deg, #059669, #34d399);
        height: 140px;
        border-radius: 0 0 30px 30px;
        margin-bottom: -70px;
    }

    /* CARD */
    .profile-card {
        background: white;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
    }

    /* AVATAR */
    .avatar-wrapper {
        width: 120px;
        height: 120px;
        margin: auto;
    }

    .profile-avatar {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 5px solid white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    /* STATS */
    .stats-box {
        background: #f1f5f9;
        border-radius: 12px;
        padding: 12px;
        transition: 0.3s;
    }

    .stats-box:hover {
        background: #ecfdf5;
        transform: translateY(-3px);
    }

    .stats-value {
        font-weight: bold;
        font-size: 18px;
    }

    .stats-label {
        font-size: 13px;
        color: #64748b;
    }

    /* FORM */
    .form-label {
        font-weight: 600;
    }

    .form-control {
        border-radius: 10px;
    }

    /* BUTTON */
    .btn-success {
        background: #059669;
        border: none;
    }

    .btn-success:hover {
        background: #047857;
    }
</style>
@endsection


@section('content')

@php
$user = auth()->user();
@endphp

<div class="profile-header-bg"></div>

<div class="container pb-5">

    <div class="row">

        {{-- LEFT SIDE --}}
        <div class="col-lg-4">

            <div class="profile-card text-center">

                <div style="height:50px;"></div>

                <div class="avatar-wrapper">

                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=059669&color=fff&size=200"
                        class="profile-avatar">

                </div>

                <h4 class="fw-bold mt-3">
                    {{ $user->name }}
                </h4>

                <p class="text-muted">
                    Member since {{ $user->created_at->format('M Y') }}
                </p>

                <div class="row mt-3">

                    <div class="col-4">
                        <div class="stats-box">
                            <div class="stats-value">{{ $ordersCount ?? 0 }}</div>
                            <div class="stats-label">Orders</div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="stats-box">
                            <div class="stats-value">{{ $wishlistCount ?? 0 }}</div>
                            <div class="stats-label">Wishlist</div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="stats-box">
                            <div class="stats-value">{{ $reviewsCount ?? 0 }}</div>
                            <div class="stats-label">Reviews</div>
                        </div>
                    </div>

                </div>

            </div>


            <div class="profile-card">

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit" class="btn btn-danger w-100">
                        Logout
                    </button>

                </form>

            </div>

        </div>



        {{-- RIGHT SIDE --}}
        <div class="col-lg-8">

            <div class="profile-card">

                <div class="d-flex justify-content-between mb-4">

                    <h5>
                        Personal Information
                    </h5>

                    <button class="btn btn-success"
                        data-bs-toggle="modal"
                        data-bs-target="#editModal">

                        Edit Profile

                    </button>

                </div>


                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">Full Name</label>

                        <input type="text"
                            value="{{ $user->name }}"
                            class="form-control"
                            readonly>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">Email</label>

                        <input type="email"
                            value="{{ $user->email }}"
                            class="form-control"
                            readonly>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">City</label>

                        <input type="text"
                            value="{{ $user->city ?? 'Not added' }}"
                            class="form-control"
                            readonly>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">State</label>

                        <input type="text"
                            value="{{ $user->state ?? 'Not added' }}"
                            class="form-control"
                            readonly>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">Pincode</label>

                        <input type="text"
                            value="{{ $user->pincode ?? 'Not added' }}"
                            class="form-control"
                            readonly>

                    </div>


                    <div class="col-12 mb-3">

                        <label class="form-label">Address</label>

                        <input type="text"
                            value="{{ $user->address ?? 'Not added' }}"
                            class="form-control"
                            readonly>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



{{-- EDIT PROFILE MODAL --}}
<div class="modal fade" id="editModal">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5>Edit Profile</h5>

                <button class="btn-close"
                    data-bs-dismiss="modal"></button>

            </div>


            <div class="modal-body">

                <form action="{{ route('profile.update') }}" method="POST">

                    @csrf
                    @method('PUT')

                    <input type="text"
                        name="name"
                        value="{{ $user->name }}"
                        class="form-control mb-3"
                        placeholder="Name">

                    <input type="text"
                        name="address"
                        value="{{ $user->address }}"
                        class="form-control mb-3"
                        placeholder="Address">

                    <input type="text"
                        name="city"
                        value="{{ $user->city }}"
                        class="form-control mb-3"
                        placeholder="City">

                    <input type="text"
                        name="state"
                        value="{{ $user->state }}"
                        class="form-control mb-3"
                        placeholder="State">

                    <input type="text"
                        name="pincode"
                        value="{{ $user->pincode }}"
                        class="form-control mb-3"
                        placeholder="Pincode">

                    <button class="btn btn-success w-100">
                        Update Profile
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection