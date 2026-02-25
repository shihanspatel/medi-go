@extends('after_login_master_nav')

@section('title', 'My Orders - Medi-Go')

@section('content')

<div class="page-header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold m-0 text-dark">My Orders</h2>
                <p class="text-muted m-0">Track and manage your orders</p>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">

@forelse($orders as $order)

<div class="order-card mb-4">

    {{-- Order Header --}}
    <div class="order-header d-flex justify-content-between align-items-center">

        <div>
            <div class="text-muted small fw-bold text-uppercase">Order ID</div>
            <div class="order-id">#MG-{{ $order->id }}</div>
            <div class="order-date small text-muted">
                {{ $order->created_at->format('M d, Y') }}
            </div>
        </div>

        {{-- Status Badge --}}
        @php
            $statusClass = match($order->status) {
                'Delivered' => 'status-delivered',
                'Processing' => 'status-processing',
                'Shipped' => 'status-shipped',
                'Cancelled' => 'status-cancelled',
                default => 'status-processing'
            };
        @endphp

        <span class="status-badge {{ $statusClass }}">
            {{ $order->status }}
        </span>

    </div>

    {{-- Order Body --}}
    <div class="order-body">

        <div class="row align-items-center">

            {{-- Product Thumbnails --}}
            <div class="col-md-8 mb-3 mb-md-0">

                <h6 class="fw-bold mb-3 text-secondary">
                    Items in this order:
                </h6>

                <div class="product-thumbs d-flex gap-2">

                    @foreach($order->items->take(3) as $item)
                        <img src="{{ asset('storage/'.$item->product->image) }}"
                             class="thumb-img"
                             alt="{{ $item->product->name }}">
                    @endforeach

                    @if($order->items->count() > 3)
                        <div class="more-items">
                            +{{ $order->items->count() - 3 }}
                        </div>
                    @endif

                </div>

            </div>

            {{-- Order Summary --}}
            <div class="col-md-4">
                <div class="bg-light p-3 rounded-4">

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Total Amount</span>
                        <span class="fw-bold">
                            ₹{{ number_format($order->total_amount, 2) }}
                        </span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span class="text-muted small">Total Items</span>
                        <span class="fw-bold">
                            {{ $order->items->sum('quantity') }}
                        </span>
                    </div>

                </div>
            </div>

        </div>

        {{-- Footer --}}
        <div class="order-footer d-flex justify-content-end mt-4">

            <a href="#"
               class="btn btn-outline-dark rounded-pill btn-sm px-4 fw-bold">
                View Details
            </a>

        </div>

    </div>

</div>

@empty

<div class="text-center py-5">
    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
    <h4>No Orders Found</h4>
    <p class="text-muted">You haven't placed any orders yet.</p>
    <a href="{{ url('/medicines') }}"
       class="btn btn-primary rounded-pill px-4 mt-3">
        Shop Now
    </a>
</div>

@endforelse

</div>

@endsection