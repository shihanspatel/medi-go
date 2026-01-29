@extends('admin.master_admin')

@section('title','Admin Wishlist')
@section('page-title','Wishlist')

@section('content')

<div class="card border-0 shadow-sm rounded-4 p-4">
    <h5 class="fw-bold mb-3">Wishlist Products</h5>

    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Vitamin C Tablets</td>
                    <td>Wellness</td>
                    <td>₹120</td>
                    <td><span class="badge bg-success">Available</span></td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-success">
                            <i class="fas fa-cart-plus"></i>
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

@endsection
