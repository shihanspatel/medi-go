@extends('admin.master_admin')

@section('title','Contact Messages')
@section('page-title','Contact Us')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif

<div class="card border-0 shadow-sm rounded-4 p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">All Contact Messages</h5>
    </div>

    <div class="mb-3">
        <input type="text" id="contactSearch" class="form-control rounded-pill" placeholder="Search by name or email...">
    </div>

    <div class="table-responsive">
        <table class="table align-middle table-hover" id="contactTable">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $i => $msg)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $msg->first_name }} {{ $msg->last_name }}</td>
                    <td>{{ $msg->email }}</td>
                    <td>{{ $msg->phone ?? '-' }}</td>
                    <td>{{ Str::limit($msg->message, 50) }}</td>
                    <td>{{ $msg->created_at->format('d-m-Y') }}</td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-primary"
                            onclick="viewMessage('{{ addslashes($msg->first_name . ' ' . $msg->last_name) }}','{{ $msg->email }}','{{ $msg->phone }}','{{ addslashes($msg->message) }}','{{ $msg->created_at->format('d-m-Y') }}')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-success"
                            onclick="openReplyModal({{ $msg->id }}, '{{ addslashes($msg->first_name) }}')">
                            <i class="fas fa-reply"></i>
                        </button>
                        <form action="{{ route('admin.contact.delete', $msg->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirmDelete('Delete this message?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted">No messages found.</td></tr>
                @endforelse
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
        <p><b>Phone:</b> <span id="v_c_phone"></span></p>
        <p><b>Message:</b></p>
        <div class="border rounded p-3 bg-light"><span id="v_c_message"></span></div>
        <p class="mt-2"><b>Date:</b> <span id="v_c_date"></span></p>
      </div>
    </div>
  </div>
</div>

<!-- REPLY MODAL -->
<div class="modal fade" id="replyModal">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title">Reply to <span id="reply_user_name"></span></h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="replyForm" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Reply Message</label>
                <textarea name="reply_message" class="form-control" rows="6" placeholder="Type your reply here..." required></textarea>
                <small class="text-muted">This message will be sent to the user via email.</small>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane me-2"></i>Send Reply</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
function viewMessage(name, email, phone, message, date) {
    document.getElementById('v_c_name').innerText = name;
    document.getElementById('v_c_email').innerText = email;
    document.getElementById('v_c_phone').innerText = phone || '-';
    document.getElementById('v_c_message').innerText = message;
    document.getElementById('v_c_date').innerText = date;
    new bootstrap.Modal(document.getElementById('viewMessageModal')).show();
}

function openReplyModal(contactId, userName) {
    document.getElementById('reply_user_name').innerText = userName;
    document.getElementById('replyForm').action = '/admin/contact/' + contactId + '/reply';
    new bootstrap.Modal(document.getElementById('replyModal')).show();
}

document.getElementById('contactSearch').addEventListener('keyup', function () {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#contactTable tbody tr').forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>
@endsection
