@extends('admin.master_admin')

@section('title','My Profile - MediSwift')

@section('content')

<section class="py-5 bg-light">
    <div class="container">
        <h3 class="fw-bold mb-4">My Profile</h3>

        <div class="row">
            <!-- Left Profile Card -->
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 text-center">
                    <div class="mb-3">
                        <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center"
                             style="width:100px;height:100px;font-size:2.5rem;">
                            P
                        </div>
                    </div>
                    <h5 class="fw-bold">Priyal Antala</h5>
                    <p class="text-muted mb-1">priyal@gmail.com</p>
                    <p class="text-muted">+91 9876543210</p>
                    <button class="btn btn-outline-success rounded-pill mt-2">
                        Change Photo
                    </button>
                </div>

                <!-- Account Summary -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mt-3">
                    <h6 class="fw-bold mb-3">Account Summary</h6>
                    <p>Total Orders: <b>12</b></p>
                    <p>Wishlist Items: <b>5</b></p>
                    <p>Reviews Given: <b>3</b></p>
                </div>
            </div>

            <!-- Right Profile Form -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h5 class="fw-bold mb-3">Personal Information</h5>
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label>Name</label>
                                <input type="text" class="form-control" value="Priyal Antala">
                            </div>
                            <div class="col-md-6">
                                <label>Email</label>
                                <input type="email" class="form-control" value="priyal@gmail.com">
                            </div>
                            <div class="col-md-6">
                                <label>Mobile</label>
                                <input type="text" class="form-control" value="9876543210">
                            </div>
                            <div class="col-md-6">
                                <label>Birth Date</label>
                                <input type="date" class="form-control" value="2003-01-01">
                            </div>
                        </div>
                        <button class="btn btn-success rounded-pill mt-3">
                            Save Changes
                        </button>
                    </form>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h5 class="fw-bold mb-3">Address Information</h5>
                    <form>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label>Address</label>
                                <input type="text" class="form-control" value="Street 1, Near Hospital">
                            </div>
                            <div class="col-md-4">
                                <label>City</label>
                                <input type="text" class="form-control" value="Rajkot">
                            </div>
                            <div class="col-md-4">
                                <label>State</label>
                                <input type="text" class="form-control" value="Gujarat">
                            </div>
                            <div class="col-md-4">
                                <label>Pincode</label>
                                <input type="text" class="form-control" value="360001">
                            </div>
                        </div>
                        <button class="btn btn-success rounded-pill mt-3">
                            Update Address
                        </button>
                    </form>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h5 class="fw-bold mb-3">Change Password</h5>
                    <form>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label>Current Password</label>
                                <input type="password" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label>New Password</label>
                                <input type="password" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control">
                            </div>
                        </div>
                        <button class="btn btn-danger rounded-pill mt-3">
                            Change Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
