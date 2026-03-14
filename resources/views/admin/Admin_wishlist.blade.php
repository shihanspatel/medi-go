@extends('admin.master_admin')

@section('title','Admin Wishlist')
@section('page-title','Wishlist')

@section('content')

<div class="card border-0 shadow-sm rounded-4 p-4">
    <h5 class="fw-bold mb-3">All Wishlist Items</h5>

    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @forelse($wishlists as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->user->name ?? 'N/A' }}</td>
                    <td>{{ $item->product->name ?? 'N/A' }}</td>
                    <td>{{ $item->product->category ?? '-' }}</td>
                    <td>₹{{ $item->product->price ?? 0 }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted">No wishlist items found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
