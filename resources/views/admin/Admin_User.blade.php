@extends('admin.master_admin')

@section('title','Users Management')
@section('page-title','Users')

@section('content')

<div class="card border-0 shadow-sm rounded-4 p-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">All Users</h5>
        <button class="btn btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="fas fa-user-plus me-2"></i> Add User
        </button>
    </div>

    <!-- Search -->
    <div class="mb-3">
        <input type="text" class="form-control rounded-pill" placeholder="Search users...">
    </div>

    <!-- Users Table -->
    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Demo Static Row -->
                <tr>
                    <td>1</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="admin-avatar">P</div>
                        </div>
                    </td>
                    <td>Priyal Antala</td>
                    <td>priyal@gmail.com</td>
                    <td>9876543210</td>
                    <td>Kotharia,Rajkot</td>
                    <td>Rajkot</td>
                    <td>Guja        rat</td>
                    <td><span class="badge bg-success">Active</span></td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-primary"
                            onclick="viewUser('Priyal','priyal@gmail.com','9876543210','Street 1','Rajkot','Gujarat','2003-01-01','360001')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-warning"
                            onclick="editUser('Priyal','priyal@gmail.com','9876543210','Street 1','Rajkot','Gujarat','2003-01-01','360001')">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<!-- ADD USER MODAL -->
<div class="modal fade" id="addUserModal">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title">Add User</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form>
            <div class="row g-2">
                <div class="col-md-6"><input class="form-control" placeholder="Full Name"></div>
                <div class="col-md-6"><input class="form-control" placeholder="Email"></div>
                <div class="col-md-6"><input class="form-control" placeholder="Mobile"></div>
                <div class="col-md-6"><input type="date" class="form-control"></div>
                <div class="col-md-12"><input class="form-control" placeholder="Address"></div>
                <div class="col-md-4"><input class="form-control" placeholder="City"></div>
                <div class="col-md-4"><input class="form-control" placeholder="State"></div>
                <div class="col-md-4"><input class="form-control" placeholder="Pincode"></div>
            </div>
            <button class="btn btn-success w-100 mt-3">Save User</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- VIEW USER MODAL -->
<div class="modal fade" id="viewUserModal">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title">View User</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
            <div class="col-md-6"><b>Name:</b> <span id="v_name"></span></div>
            <div class="col-md-6"><b>Email:</b> <span id="v_email"></span></div>
            <div class="col-md-6"><b>Mobile:</b> <span id="v_mobile"></span></div>
            <div class="col-md-6"><b>Birth Date:</b> <span id="v_dob"></span></div>
            <div class="col-md-12"><b>Address:</b> <span id="v_address"></span></div>
            <div class="col-md-4"><b>City:</b> <span id="v_city"></span></div>
            <div class="col-md-4"><b>State:</b> <span id="v_state"></span></div>
            <div class="col-md-4"><b>Pincode:</b> <span id="v_pincode"></span></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- EDIT USER MODAL -->
<div class="modal fade" id="editUserModal">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title">Edit User</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form>
            <div class="row g-2">
                <div class="col-md-6"><input id="e_name" class="form-control"></div>
                <div class="col-md-6"><input id="e_email" class="form-control"></div>
                <div class="col-md-6"><input id="e_mobile" class="form-control"></div>
                <div class="col-md-6"><input id="e_dob" type="date" class="form-control"></div>
                <div class="col-md-12"><input id="e_address" class="form-control"></div>
                <div class="col-md-4"><input id="e_city" class="form-control"></div>
                <div class="col-md-4"><input id="e_state" class="form-control"></div>
                <div class="col-md-4"><input id="e_pincode" class="form-control"></div>
            </div>
            <button class="btn btn-warning w-100 mt-3">Update User</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
function viewUser(name,email,mobile,address,city,state,dob,pincode){
    v_name.innerText=name;
    v_email.innerText=email;
    v_mobile.innerText=mobile;
    v_address.innerText=address;
    v_city.innerText=city;
    v_state.innerText=state;
    v_dob.innerText=dob;
    v_pincode.innerText=pincode;
    new bootstrap.Modal(viewUserModal).show();
}

function editUser(name,email,mobile,address,city,state,dob,pincode){
    e_name.value=name;
    e_email.value=email;
    e_mobile.value=mobile;
    e_address.value=address;
    e_city.value=city;
    e_state.value=state;
    e_dob.value=dob;
    e_pincode.value=pincode;
    new bootstrap.Modal(editUserModal).show();
}
</script>

@endsection
