@extends('admin.master_admin')

@section('title','Offers Management')
@section('page-title','Offers')

@section('content')

<div class="card border-0 shadow-sm rounded-4 p-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">All Offers</h5>
        <button class="btn btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#addOfferModal">
            <i class="fas fa-tags me-2"></i> Add Offer
        </button>
    </div>

    <!-- Search -->
    <div class="mb-3">
        <input type="text" class="form-control rounded-pill" placeholder="Search offers...">
    </div>

    <!-- Offers Table -->
    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Offer Code</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Valid From</th>
                    <th>Valid To</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Demo static row -->
                <tr>
                    <td>1</td>
                    <td><span class="badge bg-primary">MEDI10</span></td>
                    <td>Percentage</td>
                    <td>10%</td>
                    <td>01-02-2024</td>
                    <td>28-02-2024</td>
                    <td><span class="badge bg-success">Active</span></td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-primary"
                            onclick="viewOffer('MEDI10','Percentage','10','01-02-2024','28-02-2024','Active')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-warning"
                            onclick="editOffer('MEDI10','Percentage','10','01-02-2024','28-02-2024','Active')">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td><span class="badge bg-primary">FLAT50</span></td>
                    <td>Flat</td>
                    <td>₹50</td>
                    <td>01-02-2024</td>
                    <td>15-02-2024</td>
                    <td><span class="badge bg-secondary">Inactive</span></td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-primary"
                            onclick="viewOffer('FLAT50','Flat','50','01-02-2024','15-02-2024','Inactive')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-warning"
                            onclick="editOffer('FLAT50','Flat','50','01-02-2024','15-02-2024','Inactive')">
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

<!-- ADD OFFER MODAL -->
<div class="modal fade" id="addOfferModal">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title">Add Offer</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form>
            <div class="row g-2">
                <div class="col-md-6">
                    <label>Offer Code</label>
                    <input class="form-control" placeholder="e.g. MEDI20">
                </div>
                <div class="col-md-6">
                    <label>Discount Type</label>
                    <select class="form-control">
                        <option>Percentage</option>
                        <option>Flat</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Discount Value</label>
                    <input class="form-control" placeholder="e.g. 10 or 50">
                </div>
                <div class="col-md-4">
                    <label>Valid From</label>
                    <input type="date" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Valid To</label>
                    <input type="date" class="form-control">
                </div>
                <div class="col-md-12">
                    <label>Status</label>
                    <select class="form-control">
                        <option>Active</option>
                        <option>Inactive</option>
                    </select>
                </div>
            </div>
            <button class="btn btn-success w-100 mt-3">Save Offer</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- VIEW OFFER MODAL -->
<div class="modal fade" id="viewOfferModal">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title">View Offer</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p><b>Offer Code:</b> <span id="v_o_code"></span></p>
        <p><b>Type:</b> <span id="v_o_type"></span></p>
        <p><b>Value:</b> <span id="v_o_value"></span></p>
        <p><b>Valid From:</b> <span id="v_o_from"></span></p>
        <p><b>Valid To:</b> <span id="v_o_to"></span></p>
        <p><b>Status:</b> <span id="v_o_status"></span></p>
      </div>
    </div>
  </div>
</div>

<!-- EDIT OFFER MODAL -->
<div class="modal fade" id="editOfferModal">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title">Edit Offer</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form>
            <div class="row g-2">
                <div class="col-md-6">
                    <label>Offer Code</label>
                    <input id="e_o_code" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Discount Type</label>
                    <select id="e_o_type" class="form-control">
                        <option>Percentage</option>
                        <option>Flat</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Discount Value</label>
                    <input id="e_o_value" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Valid From</label>
                    <input id="e_o_from" type="date" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Valid To</label>
                    <input id="e_o_to" type="date" class="form-control">
                </div>
                <div class="col-md-12">
                    <label>Status</label>
                    <select id="e_o_status" class="form-control">
                        <option>Active</option>
                        <option>Inactive</option>
                    </select>
                </div>
            </div>
            <button class="btn btn-warning w-100 mt-3">Update Offer</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
function viewOffer(code,type,value,from,to,status){
    v_o_code.innerText = code;
    v_o_type.innerText = type;
    v_o_value.innerText = value;
    v_o_from.innerText = from;
    v_o_to.innerText = to;
    v_o_status.innerText = status;
    new bootstrap.Modal(viewOfferModal).show();
}

function editOffer(code,type,value,from,to,status){
    e_o_code.value = code;
    e_o_type.value = type;
    e_o_value.value = value;
    e_o_from.value = from;
    e_o_to.value = to;
    e_o_status.value = status;
    new bootstrap.Modal(editOfferModal).show();
}
</script>

@endsection
