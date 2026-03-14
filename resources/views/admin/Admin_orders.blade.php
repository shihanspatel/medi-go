@extends('admin.master_admin')

@section('title','Orders Management')
@section('page-title','Orders')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif

<div class="card border-0 shadow-sm rounded-4 p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">All Orders</h5>
    </div>

    <div class="mb-3">
        <input type="text" id="orderSearch" class="form-control rounded-pill" placeholder="Search by user or order ID...">
    </div>

    <div class="table-responsive">
        <table class="table align-middle table-hover" id="ordersTable">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Order ID</th>
                    <th>User</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $i => $order)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>#ORD{{ $order->id }}</td>
                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                    <td>₹{{ $order->total_amount }}</td>
                    <td>
                        <span class="badge {{ $order->payment_status === 'paid' ? 'bg-success' : 'bg-warning' }}">
                            {{ ucfirst($order->payment_status ?? 'pending') }}
                        </span>
                    </td>
                    <td>
                        @php
                            $statusColors = ['pending'=>'warning','confirmed'=>'info','shipped'=>'primary','delivered'=>'success','cancelled'=>'danger'];
                            $color = $statusColors[$order->status] ?? 'secondary';
                        @endphp
                        <span class="badge bg-{{ $color }}">{{ ucfirst($order->status) }}</span>
                    </td>
                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-primary"
                            onclick="viewOrder({{ $order->id }}, '{{ $order->user->name ?? 'N/A' }}', '{{ $order->total_amount }}', '{{ $order->payment_status }}', '{{ $order->status }}', '{{ $order->created_at->format('d-m-Y') }}')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-warning"
                            onclick="openStatusModal({{ $order->id }}, '{{ $order->status }}')">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center text-muted">No orders found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- VIEW ORDER MODAL -->
<div class="modal fade" id="viewOrderModal">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title">Order Details</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p><b>Order ID:</b> #ORD<span id="v_o_id"></span></p>
        <p><b>User:</b> <span id="v_o_user"></span></p>
        <p><b>Total:</b> ₹<span id="v_o_total"></span></p>
        <p><b>Payment:</b> <span id="v_o_payment"></span></p>
        <p><b>Status:</b> <span id="v_o_status"></span></p>
        <p><b>Date:</b> <span id="v_o_date"></span></p>
      </div>
    </div>
  </div>
</div>

<!-- UPDATE STATUS MODAL -->
<div class="modal fade" id="statusModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title">Update Order Status</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="statusForm" method="POST">
            @csrf @method('PUT')
            <select name="status" id="statusSelect" class="form-control mb-3">
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="shipped">Shipped</option>
                <option value="delivered">Delivered</option>
                <option value="cancelled">Cancelled</option>
            </select>
            <button class="btn btn-success w-100">Update Status</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
function viewOrder(id, user, total, payment, status, date) {
    document.getElementById('v_o_id').innerText = id;
    document.getElementById('v_o_user').innerText = user;
    document.getElementById('v_o_total').innerText = total;
    document.getElementById('v_o_payment').innerText = payment;
    document.getElementById('v_o_status').innerText = status;
    document.getElementById('v_o_date').innerText = date;
    new bootstrap.Modal(document.getElementById('viewOrderModal')).show();
}

function openStatusModal(id, currentStatus) {
    document.getElementById('statusForm').action = '/admin/orders/' + id + '/status';
    document.getElementById('statusSelect').value = currentStatus;
    new bootstrap.Modal(document.getElementById('statusModal')).show();
}

document.getElementById('orderSearch').addEventListener('keyup', function () {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#ordersTable tbody tr').forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>
@endsection
