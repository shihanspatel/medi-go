@extends('after_login_master_nav')

@section('title', 'My Profile - Medi-Go')

@section('styles')
<style>
    /* --- Page Specific Styles --- */
    body {
        background-color: #f8fafc;
    }

    /* Profile Header Background */
    .profile-header-bg {
        background: linear-gradient(135deg, var(--primary) 0%, #34d399 100%);
        height: 150px;
        border-radius: 0 0 50% 50% / 20px;
        margin-bottom: -75px;
    }

    /* Cards */
    .profile-card {
        background: white;
        border: 1px solid #f1f5f9;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        margin-bottom: 25px;
    }

    /* Avatar Section */
    .avatar-wrapper {
        position: relative;
        width: 120px;
        height: 120px;
        margin: 0 auto 15px;
    }

    .profile-avatar {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 5px solid white;
        object-fit: cover;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .edit-avatar-btn {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background: var(--dark);
        color: white;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        border: 2px solid white;
        cursor: pointer;
        transition: 0.2s;
    }

    .edit-avatar-btn:hover {
        background: var(--primary);
    }

    /* Sidebar Menu */
    .profile-menu .nav-link {
        color: #64748b;
        font-weight: 600;
        padding: 12px 20px;
        border-radius: 10px;
        margin-bottom: 5px;
        display: flex;
        align-items: center;
        transition: 0.2s;
    }

    .profile-menu .nav-link i {
        width: 25px;
        font-size: 1.1rem;
    }

    .profile-menu .nav-link:hover {
        background: #f1f5f9;
        color: var(--primary);
    }

    .profile-menu .nav-link.active {
        background: #ecfdf5;
        color: var(--primary);
    }

    .profile-menu .nav-link.text-danger:hover {
        background: #fef2f2;
        color: #ef4444;
    }

    /* --- SCOPED FORM STYLES (Fixes Navbar Issue) --- */
    /* We only target .form-control inside .profile-card or .modal-content */

    .profile-card .form-label,
    .modal-content .form-label {
        font-weight: 700;
        font-size: 0.85rem;
        color: #475569;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .profile-card .form-control,
    .modal-content .form-control {
        padding: 12px 15px;
        border-radius: 12px;
        border: 2px solid #f1f5f9;
        background-color: #fcfcfc;
        font-weight: 500;
        transition: 0.2s;
    }

    .profile-card .form-control:focus,
    .modal-content .form-control:focus {
        background-color: white;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.1);
    }

    /* Read Only Inputs */
    .profile-card .form-control:disabled,
    .profile-card .form-control[readonly] {
        background-color: #f8fafc;
        opacity: 1;
        border-color: #e2e8f0;
        color: #64748b;
    }

    /* Stats Grid */
    .stats-box {
        background: #f8fafc;
        padding: 15px;
        border-radius: 12px;
        text-align: center;
    }

    .stats-value {
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--dark);
    }

    .stats-label {
        font-size: 0.8rem;
        color: #94a3b8;
        font-weight: 600;
    }

    /* Modal Styles */
    .modal-content {
        border-radius: 20px;
        border: none;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        border-bottom: 1px solid #f1f5f9;
        padding: 20px 25px;
    }

    .modal-body {
        padding: 25px;
    }
</style>
@endsection

@section('content')

<div class="profile-header-bg"></div>

<div class="container pb-5">
    <div class="row">

        <div class="col-lg-4">

            <div class="profile-card text-center p-4 pt-0" style="margin-top: 0;">
                <div style="height: 50px;"></div>
                <div class="avatar-wrapper">
                    <img src="https://ui-avatars.com/api/?name=John+Doe&background=059669&color=fff&size=200" alt="User" class="profile-avatar">
                    <div class="edit-avatar-btn" title="Change Photo" data-bs-toggle="modal" data-bs-target="#uploadPhotoModal"><i class="fas fa-camera"></i></div>
                </div>

                <h4 class="fw-bold text-dark mb-1">John Doe</h4>
                <p class="text-muted small mb-4">Member since Jan 2024</p>

                <div class="row g-2 mb-4">
                    <div class="col-4">
                        <div class="stats-box">
                            <div class="stats-value">12</div>
                            <div class="stats-label">Orders</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stats-box">
                            <div class="stats-value">5</div>
                            <div class="stats-label">Wishlist</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stats-box">
                            <div class="stats-value">2</div>
                            <div class="stats-label">Reviews</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="profile-card p-3">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link w-100 text-start text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>

        </div>

        <div class="col-lg-8">
            <div style="height: 75px;" class="d-none d-lg-block"></div>

            <div class="profile-card p-4 p-md-5 mb-4" data-aos="fade-up">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold m-0"><i class="fas fa-user-edit text-success me-2"></i> Personal Information</h5>
                    <button class="btn btn-sm btn-outline-dark rounded-pill px-3 fw-bold" data-bs-toggle="modal" data-bs-target="#editInfoModal">
                        <i class="fas fa-pen me-1"></i> Edit
                    </button>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" value="John" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" value="Doe" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control" value="john.doe@example.com" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" value="+1 (555) 123-4567" readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" value="123 Main Street, New York, NY 10012" readonly>
                    </div>
                </div>
            </div>

            <div class="profile-card p-4 p-md-5" data-aos="fade-up" data-aos-delay="100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold m-0"><i class="fas fa-lock text-success me-2"></i> Security & Password</h5>
                    <button class="btn btn-sm btn-outline-dark rounded-pill px-3 fw-bold" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                        <i class="fas fa-key me-1"></i> Change
                    </button>
                </div>

                <div class="alert alert-light border-secondary-subtle d-flex align-items-center" role="alert">
                    <i class="fas fa-shield-alt text-success fs-4 me-3"></i>
                    <div class="small text-secondary">
                        Password last changed: <strong>3 months ago</strong>. <br>
                        We recommend using a strong password with letters, numbers, and symbols.
                    </div>
                </div>

                <div class="row g-3 opacity-50">
                    <div class="col-12">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" value="********" disabled>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="editInfoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Update Profile Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" value="John">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" value="Doe">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" value="+1 (555) 123-4567">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Address</label>
                        <textarea class="form-control" rows="3">123 Main Street, New York, NY 10012</textarea>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-light w-100 rounded-pill fw-bold" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success w-100 rounded-pill fw-bold">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-top border-4 border-success">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Current Password</label>
                        <input type="password" class="form-control" placeholder="••••••••">
                    </div>
                    <hr class="my-4 text-secondary opacity-25">
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" class="form-control" placeholder="Minimum 8 characters">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" placeholder="Confirm password">
                    </div>
                    <button type="button" class="btn btn-dark w-100 py-2 rounded-pill fw-bold">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="uploadPhotoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content text-center p-3">
            <div class="modal-body">
                <div class="mb-3">
                    <i class="fas fa-cloud-upload-alt text-success display-4"></i>
                </div>
                <h6 class="fw-bold mb-3">Upload Profile Photo</h6>
                <input type="file" class="form-control form-control-sm mb-3">
                <button type="button" class="btn btn-success w-100 rounded-pill btn-sm fw-bold">Upload</button>
            </div>
        </div>
    </div>
</div>

@endsection