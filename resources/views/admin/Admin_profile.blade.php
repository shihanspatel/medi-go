@extends('admin.master_admin')

@section('title','My Profile')
@section('page-title','Profile')

@section('content')

<style>
    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, #059669, #047857);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        font-weight: 800;
        color: white;
        margin: 0 auto 15px;
        box-shadow: 0 8px 20px rgba(5,150,105,0.3);
    }
    .info-row {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .info-row:last-child { border-bottom: none; }
    .info-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: #ecfdf5;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #059669;
        flex-shrink: 0;
    }
    .form-control:focus {
        border-color: #059669;
        box-shadow: 0 0 0 0.2rem rgba(5,150,105,0.15);
    }
    .section-title {
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
        padding-bottom: 12px;
        margin-bottom: 20px;
        border-bottom: 2px solid #ecfdf5;
    }
</style>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4">
        <i class="fas fa-exclamation-circle me-2"></i>{{ $errors->first() }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row g-4">

    {{-- LEFT PANEL --}}
    <div class="col-lg-4">

        {{-- Avatar Card --}}
        <div class="card border-0 shadow-sm rounded-4 p-4 text-center mb-4">
            <div class="profile-avatar">
                {{ strtoupper(substr($admin->name, 0, 1)) }}
            </div>
            <h5 class="fw-bold mb-1">{{ $admin->name }}</h5>
            <p class="text-muted small mb-3">{{ $admin->email }}</p>
            <span class="badge bg-danger rounded-pill px-3 py-2">
                <i class="fas fa-shield-alt me-1"></i> Administrator
            </span>
        </div>

        {{-- Info Card --}}
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <p class="section-title"><i class="fas fa-info-circle text-success me-2"></i>Account Info</p>

            <div class="info-row">
                <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                <div>
                    <small class="text-muted d-block">Location</small>
                    <span class="fw-semibold small">
                        {{ ($admin->city && $admin->state) ? $admin->city.', '.$admin->state : 'Not set' }}
                    </span>
                </div>
            </div>

            <div class="info-row">
                <div class="info-icon"><i class="fas fa-home"></i></div>
                <div>
                    <small class="text-muted d-block">Address</small>
                    <span class="fw-semibold small">{{ $admin->address ?? 'Not set' }}</span>
                </div>
            </div>

            <div class="info-row">
                <div class="info-icon"><i class="fas fa-envelope"></i></div>
                <div>
                    <small class="text-muted d-block">Pincode</small>
                    <span class="fw-semibold small">{{ $admin->pincode ?? 'Not set' }}</span>
                </div>
            </div>

            <div class="info-row">
                <div class="info-icon"><i class="fas fa-user-tag"></i></div>
                <div>
                    <small class="text-muted d-block">Role</small>
                    <span class="fw-semibold small text-danger">Admin</span>
                </div>
            </div>
        </div>

    </div>

    {{-- RIGHT PANEL --}}
    <div class="col-lg-8 d-flex flex-column gap-4">

        {{-- Personal Info Form --}}
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <p class="section-title">
                <i class="fas fa-user-edit text-success me-2"></i>Personal Information
            </p>
            <form action="{{ route('admin.profile.update') }}" method="POST">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Full Name</label>
                        <input type="text" name="name"
                               class="form-control rounded-3 @error('name') is-invalid @enderror"
                               value="{{ old('name', $admin->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Email Address</label>
                        <input type="email" name="email"
                               class="form-control rounded-3 @error('email') is-invalid @enderror"
                               value="{{ old('email', $admin->email) }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-semibold small">Address</label>
                        <input type="text" name="address"
                               class="form-control rounded-3"
                               value="{{ old('address', $admin->address) }}"
                               placeholder="Enter your address">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold small">City</label>
                        <input type="text" name="city"
                               class="form-control rounded-3"
                               value="{{ old('city', $admin->city) }}"
                               placeholder="City">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold small">State</label>
                        <input type="text" name="state"
                               class="form-control rounded-3"
                               value="{{ old('state', $admin->state) }}"
                               placeholder="State">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold small">Pincode</label>
                        <input type="text" name="pincode"
                               class="form-control rounded-3"
                               value="{{ old('pincode', $admin->pincode) }}"
                               placeholder="Pincode">
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-success rounded-pill px-4 fw-bold">
                        <i class="fas fa-save me-2"></i>Save Changes
                    </button>
                </div>
            </form>
        </div>

        {{-- Change Password Form --}}
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <p class="section-title">
                <i class="fas fa-lock text-danger me-2"></i>Change Password
            </p>
            <form action="{{ route('admin.profile.password') }}" method="POST">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold small">Current Password</label>
                        <input type="password" name="current_password"
                               class="form-control rounded-3 @error('current_password') is-invalid @enderror"
                               placeholder="••••••••" required>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold small">New Password</label>
                        <input type="password" name="password"
                               class="form-control rounded-3"
                               placeholder="••••••••" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold small">Confirm Password</label>
                        <input type="password" name="password_confirmation"
                               class="form-control rounded-3"
                               placeholder="••••••••" required>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold">
                        <i class="fas fa-key me-2"></i>Change Password
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection
