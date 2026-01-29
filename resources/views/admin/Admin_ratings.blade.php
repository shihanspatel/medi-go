@extends('admin.master_admin')

@section('title','Ratings & Reviews')
@section('page-title','Ratings')

@section('content')

<div class="card border-0 shadow-sm rounded-4 p-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">All Ratings & Reviews</h5>
    </div>

    <!-- Filters -->
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" class="form-control rounded-pill" placeholder="Search by user or product...">
        </div>
        <div class="col-md-4">
            <select class="form-control rounded-pill">
                <option>All Status</option>
                <option>Approved</option>
                <option>Pending</option>
                <option>Rejected</option>
            </select>
        </div>
        <div class="col-md-4">
            <select class="form-control rounded-pill">
                <option>All Ratings</option>
                <option>5 Stars</option>
                <option>4 Stars</option>
                <option>3 Stars</option>
                <option>2 Stars</option>
                <option>1 Star</option>
            </select>
        </div>
    </div>

    <!-- Ratings Table -->
    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Product</th>
                    <th>Rating</th>
                    <th>Review</th>
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
                    <td>Paracetamol 500mg</td>
                    <td>
                        <span class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </span>
                    </td>
                    <td>Very effective medicine!</td>
                    <td><span class="badge bg-success">Approved</span></td>
                    <td>12-02-2024</td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-primary"
                            onclick="viewRating('Priyal','Paracetamol 500mg','4','Very effective medicine!','Approved','12-02-2024')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-success"
                            onclick="updateRatingStatus('Approved')">
                            <i class="fas fa-check"></i>
                        </button>
                        <button class="btn btn-sm btn-danger"
                            onclick="updateRatingStatus('Rejected')">
                            <i class="fas fa-times"></i>
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>Ankit</td>
                    <td>Vitamin C Tablets</td>
                    <td>
                        <span class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                        </span>
                    </td>
                    <td>Good but packaging could improve.</td>
                    <td><span class="badge bg-warning">Pending</span></td>
                    <td>11-02-2024</td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-primary"
                            onclick="viewRating('Ankit','Vitamin C Tablets','3','Good but packaging could improve.','Pending','11-02-2024')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-success"
                            onclick="updateRatingStatus('Approved')">
                            <i class="fas fa-check"></i>
                        </button>
                        <button class="btn btn-sm btn-danger"
                            onclick="updateRatingStatus('Rejected')">
                            <i class="fas fa-times"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<!-- VIEW RATING MODAL -->
<div class="modal fade" id="viewRatingModal">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title">Rating Details</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p><b>User:</b> <span id="v_r_user"></span></p>
        <p><b>Product:</b> <span id="v_r_product"></span></p>
        <p><b>Rating:</b> <span id="v_r_rating"></span> Stars</p>
        <p><b>Review:</b> <span id="v_r_review"></span></p>
        <p><b>Status:</b> <span id="v_r_status"></span></p>
        <p><b>Date:</b> <span id="v_r_date"></span></p>
      </div>
    </div>
  </div>
</div>

<script>
function viewRating(user,product,rating,review,status,date){
    v_r_user.innerText = user;
    v_r_product.innerText = product;
    v_r_rating.innerText = rating;
    v_r_review.innerText = review;
    v_r_status.innerText = status;
    v_r_date.innerText = date;
    new bootstrap.Modal(viewRatingModal).show();
}

function updateRatingStatus(status){
    alert("Rating status updated to: " + status);
}
</script>

@endsection
