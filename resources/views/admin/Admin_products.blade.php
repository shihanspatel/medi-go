@extends('admin.master_admin')

@section('title','Products Management')
@section('page-title','Products')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif

<div class="card border-0 shadow-sm rounded-4 p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">All Products</h5>
        <button class="btn btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#addProductModal">
            <i class="fas fa-plus me-2"></i> Add Product
        </button>
    </div>

    <div class="mb-3">
        <input type="text" id="productSearch" class="form-control rounded-pill" placeholder="Search products...">
    </div>

    <div class="table-responsive">
        <table class="table align-middle table-hover" id="productsTable">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $i => $product)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            @if($product->image)
                                <img src="{{ asset('images/product_Images/' . $product->image) }}" width="40" class="rounded" onerror="this.src='https://via.placeholder.com/40'">
                            @endif
                            {{ $product->name }}
                        </div>
                    </td>
                    <td>{{ $product->category }}</td>
                    <td>₹{{ $product->price }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="openEditProduct({{ $product->id }}, '{{ addslashes($product->name) }}', '{{ addslashes($product->category) }}', '{{ $product->price }}', '{{ $product->old_price }}', '{{ addslashes($product->description) }}')">
                            <i class="fas fa-edit"></i>
                        </button>
                        <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirmDelete('Delete this product? This will also delete the product image.');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted">No products found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ADD PRODUCT MODAL -->
<div class="modal fade" id="addProductModal">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title">Add Product</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-2">
                <div class="col-md-6">
                    <label>Product Name</label>
                    <input name="name" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Category</label>
                    <select name="category" class="form-control" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Price (₹)</label>
                    <input name="price" type="number" step="0.01" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Old Price (₹)</label>
                    <input name="old_price" type="number" step="0.01" class="form-control">
                </div>
                <div class="col-md-12">
                    <label>Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
                <div class="col-md-12">
                    <label>Product Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
            </div>
            <button class="btn btn-success w-100 mt-3">Save Product</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- EDIT PRODUCT MODAL -->
<div class="modal fade" id="editProductModal">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title">Edit Product</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="editProductForm" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row g-2">
                <div class="col-md-6">
                    <label>Product Name</label>
                    <input id="ep_name" name="name" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Category</label>
                    <select id="ep_category" name="category" class="form-control" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Price (₹)</label>
                    <input id="ep_price" name="price" type="number" step="0.01" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Old Price (₹)</label>
                    <input id="ep_old_price" name="old_price" type="number" step="0.01" class="form-control">
                </div>
                <div class="col-md-12">
                    <label>Description</label>
                    <textarea id="ep_desc" name="description" class="form-control"></textarea>
                </div>
                <div class="col-md-12">
                    <label>Product Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
            </div>
            <button class="btn btn-warning w-100 mt-3">Update Product</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
function openEditProduct(id, name, category, price, old_price, desc) {
    document.getElementById('ep_name').value = name;
    document.getElementById('ep_category').value = category;
    document.getElementById('ep_price').value = price;
    document.getElementById('ep_old_price').value = old_price;
    document.getElementById('ep_desc').value = desc;
    document.getElementById('editProductForm').action = '/admin/products/' + id;
    new bootstrap.Modal(document.getElementById('editProductModal')).show();
}

document.getElementById('productSearch').addEventListener('keyup', function () {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#productsTable tbody tr').forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>
@endsection
