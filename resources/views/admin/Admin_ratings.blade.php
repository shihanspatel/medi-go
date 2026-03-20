@extends('admin.master_admin')

@section('title','Ratings & Reviews')
@section('page-title','Ratings')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif

<div class="card border-0 shadow-sm rounded-4 p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">All Ratings & Reviews</h5>
    </div>

    <div class="mb-3">
        <input type="text" id="ratingSearch" class="form-control rounded-pill" placeholder="Search by user or product...">
    </div>

    <div class="table-responsive">
        <table class="table align-middle table-hover" id="ratingsTable">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Product</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Date</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ratings as $i => $rating)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $rating->user->name ?? 'N/A' }}</td>
                    <td>{{ $rating->product->name ?? 'N/A' }}</td>
                    <td>
                        <span class="text-warning">
                            @for($s = 1; $s <= 5; $s++)
                                <i class="fa{{ $s <= $rating->rating ? 's' : 'r' }} fa-star"></i>
                            @endfor
                        </span>
                    </td>
                    <td>{{ Str::limit($rating->review, 50) }}</td>
                    <td>{{ $rating->created_at->format('d-m-Y') }}</td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-primary"
                            onclick="viewRating('{{ addslashes($rating->user->name ?? 'N/A') }}','{{ addslashes($rating->product->name ?? 'N/A') }}','{{ $rating->rating }}','{{ addslashes($rating->review) }}','{{ $rating->created_at->format('d-m-Y') }}')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <form action="{{ route('admin.ratings.delete', $rating->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirmDelete('Delete this rating?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted">No ratings found.</td></tr>
                @endforelse
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
        <p><b>Date:</b> <span id="v_r_date"></span></p>
      </div>
    </div>
  </div>
</div>

<script>
function viewRating(user, product, rating, review, date) {
    document.getElementById('v_r_user').innerText = user;
    document.getElementById('v_r_product').innerText = product;
    document.getElementById('v_r_rating').innerText = rating;
    document.getElementById('v_r_review').innerText = review;
    document.getElementById('v_r_date').innerText = date;
    new bootstrap.Modal(document.getElementById('viewRatingModal')).show();
}

document.getElementById('ratingSearch').addEventListener('keyup', function () {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#ratingsTable tbody tr').forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>
@endsection
