@extends('admin.master_admin')

@section('title','Users Management')
@section('page-title','Users')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif

<div class="card border-0 shadow-sm rounded-4 p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">All Users</h5>
    </div>

    <div class="mb-3">
        <input type="text" id="userSearch" class="form-control rounded-pill" placeholder="Search users...">
    </div>

    <div class="table-responsive">
        <table class="table align-middle table-hover" id="usersTable">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $i => $user)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->city ?? '-' }}</td>
                    <td>{{ $user->state ?? '-' }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary"
                            onclick="viewUser('{{ addslashes($user->name) }}','{{ $user->email }}','{{ $user->city }}','{{ $user->state }}','{{ $user->address }}','{{ $user->pincode }}')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Delete this user?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted">No users found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- VIEW USER MODAL -->
<div class="modal fade" id="viewUserModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title">User Details</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p><b>Name:</b> <span id="v_name"></span></p>
        <p><b>Email:</b> <span id="v_email"></span></p>
        <p><b>Address:</b> <span id="v_address"></span></p>
        <p><b>City:</b> <span id="v_city"></span></p>
        <p><b>State:</b> <span id="v_state"></span></p>
        <p><b>Pincode:</b> <span id="v_pincode"></span></p>
      </div>
    </div>
  </div>
</div>

<script>
function viewUser(name, email, city, state, address, pincode) {
    document.getElementById('v_name').innerText = name;
    document.getElementById('v_email').innerText = email;
    document.getElementById('v_city').innerText = city || '-';
    document.getElementById('v_state').innerText = state || '-';
    document.getElementById('v_address').innerText = address || '-';
    document.getElementById('v_pincode').innerText = pincode || '-';
    new bootstrap.Modal(document.getElementById('viewUserModal')).show();
}

document.getElementById('userSearch').addEventListener('keyup', function () {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#usersTable tbody tr').forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>
@endsection
