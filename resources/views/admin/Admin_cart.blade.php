@extends('admin.master_admin')

@section('title','Admin Cart')
@section('page-title','Cart')

@section('content')

<div class="card border-0 shadow-sm rounded-4 p-4">
    <h5 class="fw-bold mb-3">Cart Items</h5>

    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Paracetamol 500mg</td>
                    <td>₹50</td>
                    <td>2</td>
                    <td>₹100</td>
                    <td class="text-end">
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
