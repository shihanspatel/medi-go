@extends('admin.master_admin')

@section('title','Categories Management')
@section('page-title','Categories')

@section('content')

<div class="card border-0 shadow-sm rounded-4 p-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">All Categories</h5>
        <button class="btn btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <i class="fas fa-plus me-2"></i> Add Category
        </button>
    </div>

    <!-- Search -->
    <div class="mb-3">
        <input type="text" class="form-control rounded-pill" placeholder="Search categories...">
    </div>

    <!-- Categories Table -->
    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Demo static row -->
                <tr>
                    <td>1</td>
                    <td>Medicines</td>
                    <td>All prescription medicines</td>
                    <td><span class="badge bg-success">Active</span></td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-primary"
                            onclick="viewCategory('Medicines','All prescription medicines','Active')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-warning"
                            onclick="editCategory('Medicines','All prescription medicines','Active')">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>Baby Care</td>
                    <td>Products for babies</td>
                    <td><span class="badge bg-secondary">Inactive</span></td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-primary"
                            onclick="viewCategory('Baby Care','Products for babies','Inactive')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-warning"
                            onclick="editCategory('Baby Care','Products for babies','Inactive')">
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

<!-- ADD CATEGORY MODAL -->
<div class="modal fade" id="addCategoryModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title">Add Category</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form>
            <label>Category Name</label>
            <input class="form-control mb-2" placeholder="Enter category name">

            <label>Description</label>
            <textarea class="form-control mb-2" placeholder="Enter description"></textarea>

            <label>Status</label>
            <select class="form-control mb-3">
                <option>Active</option>
                <option>Inactive</option>
            </select>

            <button class="btn btn-success w-100">Save Category</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- VIEW CATEGORY MODAL -->
<div class="modal fade" id="viewCategoryModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title">View Category</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p><b>Name:</b> <span id="v_cat_name"></span></p>
        <p><b>Description:</b> <span id="v_cat_desc"></span></p>
        <p><b>Status:</b> <span id="v_cat_status"></span></p>
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
        <form>
            <label>Category Name</label>
            <input id="e_cat_name" class="form-control mb-2">

            <label>Description</label>
            <textarea id="e_cat_desc" class="form-control mb-2"></textarea>

            <label>Status</label>
            <select id="e_cat_status" class="form-control mb-3">
                <option>Active</option>
                <option>Inactive</option>
            </select>

            <button class="btn btn-warning w-100">Update Category</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
function viewCategory(name,desc,status){
    v_cat_name.innerText = name;
    v_cat_desc.innerText = desc;
    v_cat_status.innerText = status;
    new bootstrap.Modal(viewCategoryModal).show();
}

function editCategory(name,desc,status){
    e_cat_name.value = name;
    e_cat_desc.value = desc;
    e_cat_status.value = status;
    new bootstrap.Modal(editCategoryModal).show();
}
</script>

@endsection
