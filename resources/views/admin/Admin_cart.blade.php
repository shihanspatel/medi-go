@extends('admin.master_admin')

@section('title','Admin Cart')
@section('page-title','Cart')

@section('content')

<div class="card border-0 shadow-sm rounded-4 p-4">
    <h5 class="fw-bold mb-3">All Cart Items</h5>

    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($carts as $i => $cart)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $cart->user->name ?? 'N/A' }}</td>
                    <td>{{ $cart->product->name ?? 'N/A' }}</td>
                    <td>₹{{ $cart->product->price ?? 0 }}</td>
                    <td>{{ $cart->quantity }}</td>
                    <td>₹{{ ($cart->product->price ?? 0) * $cart->quantity }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted">No cart items found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
