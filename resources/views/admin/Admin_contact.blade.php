@extends('admin.master_admin')

@section('title','Contact Us')
@section('page-title','Contact Us')

@section('content')

<div class="card border-0 shadow-sm rounded-4 p-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">All Contact Messages</h5>
    </div>

    <!-- Filters -->
    <div class="row mb-3">
        <div class="col-md-6">
            <input type="text" class="form-control rounded-pill" placeholder="Search by name or email...">
        </div>
        <div class="col-md-6">
            <select class="form-control rounded-pill">
                <option>All Status</option>
                <option>New</option>
                <option>Replied</option>
                <option>Closed</option>
            </select>
        </div>
    </div>

    <!-- Contact Table -->
    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Demo static row -->
                <tr>
                    <td>1</td>
                    <td>Priyal</td>
                    <td>priyal@gmail.com</td>
                    <td>Order not delivered</td>
                    <td><span class="badge bg-warning">New</span></td>
                    <td>12-02-2024</td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-primary"
                            onclick="viewMessage('Priyal','priyal@gmail.com','Order not delivered','My order is still pending.','New','12-02-2024')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-success"
                            onclick="updateMessageStatus('Replied')">
                            <i class="fas fa-reply"></i>
                        </button>
                        <button class="btn btn-sm btn-danger"
                            onclick="updateMessageStatus('Closed')">
                            <i class="fas fa-times"></i>
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>Ankit</td>
                    <td>ankit@gmail.com</td>
                    <td>Payment issue</td>
                    <td><span class="badge bg-success">Replied</span></td>
                    <td>10-02-2024</td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-primary"
                            onclick="viewMessage('Ankit','ankit@gmail.com','Payment issue','Money deducted but order failed.','Replied','10-02-2024')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-danger"
                            onclick="updateMessageStatus('Closed')">
                            <i class="fas fa-times"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<!-- VIEW MESSAGE MODAL -->
<div class="modal fade" id="viewMessageModal">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title">Contact Message</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p><b>Name:</b> <span id="v_c_name"></span></p>
        <p><b>Email:</b> <span id="v_c_email"></span></p>
        <p><b>Subject:</b> <span id="v_c_subject"></span></p>
        <p><b>Message:</b></p>
        <div class="border rounded p-3 bg-light">
            <span id="v_c_message"></span>
        </div>
        <p class="mt-2"><b>Status:</b> <span id="v_c_status"></span></p>
        <p><b>Date:</b> <span id="v_c_date"></span></p>
      </div>
    </div>
  </div>
</div>

<script>
function viewMessage(name,email,subject,message,status,date){
    v_c_name.innerText = name;
    v_c_email.innerText = email;
    v_c_subject.innerText = subject;
    v_c_message.innerText = message;
    v_c_status.innerText = status;
    v_c_date.innerText = date;
    new bootstrap.Modal(viewMessageModal).show();
}

function updateMessageStatus(status){
    alert("Message status updated to: " + status);
}
</script>

@endsection
