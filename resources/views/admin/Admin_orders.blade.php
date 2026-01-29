@extends('admin.master_admin')

@section('title','Orders Management')
@section('page-title','Orders')

@section('content')

<div class="card border-0 shadow-sm rounded-4 p-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">All Orders</h5>
    </div>

    <!-- Filters -->
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" class="form-control rounded-pill" placeholder="Search by order id or user...">
        </div>
        <div class="col-md-4">
            <select class="form-control rounded-pill">
                <option>All Status</option>
                <option>Pending</option>
                <option>Confirmed</option>
                <option>Shipped</option>
                <option>Delivered</option>
                <option>Cancelled</option>
            </select>
        </div>
        <div class="col-md-4">
            <input type="date" class="form-control rounded-pill">
        </div>
    </div>

    <!-- Orders Table -->
    <div class="table-responsive">
        <table class="table align-middle table-hover">
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
                <!-- Demo static row -->
                <tr>
                    <td>1</td>
                    <td>#ORD1001</td>
                    <td>Priyal</td>
                    <td>₹450</td>
                    <td><span class="badge bg-info">Online</span></td>
                    <td><span class="badge bg-warning">Pending</span></td>
                    <td>10-02-2024</td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-primary"
                            onclick="viewOrder('ORD1001','Priyal','450','Online','Pending','10-02-2024')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-success"
                            onclick="updateStatus('Confirmed')">
                            <i class="fas fa-check"></i>
                        </button>
                        <button class="btn btn-sm btn-danger">
                            <i class="fas fa-times"></i>
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>#ORD1002</td>
                    <td>Ankit</td>
                    <td>₹1200</td>
                    <td><span class="badge bg-secondary">COD</span></td>
                    <td><span class="badge bg-success">Delivered</span></td>
                    <td>08-02-2024</td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-primary"
                            onclick="viewOrder('ORD1002','Ankit','1200','COD','Delivered','08-02-2024')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </td>
                </tr>
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
        <p><b>Order ID:</b> <span id="v_o_id"></span></p>
        <p><b>User:</b> <span id="v_o_user"></span></p>
        <p><b>Total Amount:</b> ₹<span id="v_o_total"></span></p>
        <p><b>Payment Method:</b> <span id="v_o_payment"></span></p>
        <p><b>Status:</b> <span id="v_o_status"></span></p>
        <p><b>Date:</b> <span id="v_o_date"></span></p>

        <hr>
        <h6>Ordered Products</h6>
        <ul>
            <li>Paracetamol 500mg x 2</li>
            <li>Vitamin C Tablets x 1</li>
        </ul>
      </div>
    </div>
  </div>
</div>

<script>
function viewOrder(id,user,total,payment,status,date){
    v_o_id.innerText = id;
    v_o_user.innerText = user;
    v_o_total.innerText = total;
    v_o_payment.innerText = payment;
    v_o_status.innerText = status;
    v_o_date.innerText = date;
    new bootstrap.Modal(viewOrderModal).show();
}

function updateStatus(status){
    alert("Order status updated to: " + status);
}
</script>

@endsection
