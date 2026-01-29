@extends('admin.master_admin')

@section('title','Products Management')
@section('page-title','Products')

@section('content')

<div class="card border-0 shadow-sm rounded-4 p-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">All Products</h5>
        <button class="btn btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#addProductModal">
            <i class="fas fa-plus me-2"></i> Add Product
        </button>
    </div>

    <!-- Search -->
    <div class="mb-3">
        <input type="text" class="form-control rounded-pill" placeholder="Search products...">
    </div>

    <!-- Products Table -->
    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Demo static row -->
                <tr>
                    <td>1</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <img src="https://via.placeholder.com/40" class="rounded">
                            Paracetamol 500mg
                        </div>
                    </td>
                    <td>Medicines</td>
                    <td>₹50</td>
                    <td><span class="badge bg-success">In Stock</span></td>
                    <td><span class="badge bg-success">Active</span></td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-primary"
                            onclick="viewProduct('Paracetamol 500mg','Medicines','50','100','Pain relief tablet')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-warning"
                            onclick="editProduct('Paracetamol 500mg','Medicines','50','100','Pain relief tablet')">
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

<!-- ADD PRODUCT MODAL -->
<div class="modal fade" id="addProductModal">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title">Add Product</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form>
            <div class="row g-2">
                <div class="col-md-6">
                    <label>Product Name</label>
                    <input class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Category</label>
                    <select class="form-control">
                        <option>Medicines</option>
                        <option>Baby Care</option>
                        <option>Devices</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Price (₹)</label>
                    <input class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Stock</label>
                    <input class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Status</label>
                    <select class="form-control">
                        <option>Active</option>
                        <option>Inactive</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label>Description</label>
                    <textarea class="form-control"></textarea>
                </div>
                <div class="col-md-12">
                    <label>Product Image</label>
                    <input type="file" class="form-control">
                </div>
            </div>
            <button class="btn btn-success w-100 mt-3">Save Product</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- VIEW PRODUCT MODAL -->
<div class="modal fade" id="viewProductModal">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title">View Product</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p><b>Name:</b> <span id="v_p_name"></span></p>
        <p><b>Category:</b> <span id="v_p_category"></span></p>
        <p><b>Price:</b> ₹<span id="v_p_price"></span></p>
        <p><b>Stock:</b> <span id="v_p_stock"></span></p>
        <p><b>Description:</b> <span id="v_p_desc"></span></p>
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
        <form>
            <div class="row g-2">
                <div class="col-md-6">
                    <label>Product Name</label>
                    <input id="e_p_name" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Category</label>
                    <input id="e_p_category" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Price (₹)</label>
                    <input id="e_p_price" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Stock</label>
                    <input id="e_p_stock" class="form-control">
                </div>
                <div class="col-md-12">
                    <label>Description</label>
                    <textarea id="e_p_desc" class="form-control"></textarea>
                </div>
            </div>
            <button class="btn btn-warning w-100 mt-3">Update Product</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
function viewProduct(name,category,price,stock,desc){
    v_p_name.innerText=name;
    v_p_category.innerText=category;
    v_p_price.innerText=price;
    v_p_stock.innerText=stock;
    v_p_desc.innerText=desc;
    new bootstrap.Modal(viewProductModal).show();
}

function editProduct(name,category,price,stock,desc){
    e_p_name.value=name;
    e_p_category.value=category;
    e_p_price.value=price;
    e_p_stock.value=stock;
    e_p_desc.value=desc;
    new bootstrap.Modal(editProductModal).show();
}
</script>

@endsection
