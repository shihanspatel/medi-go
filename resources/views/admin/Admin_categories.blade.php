@extends('admin.master_admin')

@section('title','Categories Management')
@section('page-title','Categories')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif

<div class="card border-0 shadow-sm rounded-4 p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">All Categories</h5>
        <button class="btn btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <i class="fas fa-plus me-2"></i> Add Category
        </button>
    </div>

    <div class="mb-3">
        <input type="text" id="catSearch" class="form-control rounded-pill" placeholder="Search categories...">
    </div>

    <div class="table-responsive">
        <table class="table align-middle table-hover" id="catTable">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $i => $cat)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $cat->name }}</td>
                    <td>{{ $cat->slug }}</td>
                    <td>
                        <span class="badge {{ $cat->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                            {{ ucfirst($cat->status) }}
                        </span>
                    </td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-warning"
                            onclick="openEditCategory({{ $cat->id }}, '{{ addslashes($cat->name) }}', '{{ $cat->slug }}', '{{ $cat->status }}')">
                            <i class="fas fa-edit"></i>
                        </button>
                        <form action="{{ route('admin.categories.delete', $cat->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Delete this category?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted">No categories found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ADD CATEGORY MODAL -->
<div class="modal fade" id="addCategoryModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title">Add Category</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <label>Category Name</label>
            <input name="name" class="form-control mb-2" required>
            <label>Slug</label>
            <input name="slug" class="form-control mb-2" required>
            <label>Status</label>
            <select name="status" class="form-control mb-3">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
            <button class="btn btn-success w-100">Save Category</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- EDIT CATEGORY MODAL -->
<div class="modal fade" id="editCategoryModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title">Edit Category</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="editCatForm" method="POST">
            @csrf @method('PUT')
            <label>Category Name</label>
            <input id="ec_name" name="name" class="form-control mb-2" required>
            <label>Slug</label>
            <input id="ec_slug" name="slug" class="form-control mb-2" required>
            <label>Status</label>
            <select id="ec_status" name="status" class="form-control mb-3">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
            <button class="btn btn-warning w-100">Update Category</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
function openEditCategory(id, name, slug, status) {
    document.getElementById('ec_name').value = name;
    document.getElementById('ec_slug').value = slug;
    document.getElementById('ec_status').value = status;
    document.getElementById('editCatForm').action = '/admin/categories/' + id;
    new bootstrap.Modal(document.getElementById('editCategoryModal')).show();
}

document.getElementById('catSearch').addEventListener('keyup', function () {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#catTable tbody tr').forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>
@endsection
