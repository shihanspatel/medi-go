@extends('master_nav')

@section('title', 'Shopping Cart - Medi-Go')

@section('content')

<div class="page-header-bg">
    <div class="container">
        <h2 class="fw-bold text-dark m-0">
            Your Cart
            <span class="text-secondary fw-normal h5">
                ({{ $cartItems->count() }} Items)
            </span>
        </h2>
    </div>
</div>

<div class="container pb-5">
<div class="row g-4">

{{-- CART ITEMS --}}
<div class="col-lg-8">

@forelse($cartItems as $item)

<div class="cart-item">

    <div class="item-img-box">
        <img src="{{ asset('uploads/products/'.$item->product->image) }}"
             class="item-img"
             alt="{{ $item->product->name }}">
    </div>

    <div class="flex-grow-1 w-100">

        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h6 class="fw-bold text-dark mb-1">
                    {{ $item->product->name }}
                </h6>
                <p class="text-muted small mb-0">
                    ₹{{ number_format($item->product->price,2) }} each
                </p>
            </div>

            <h5 class="fw-bold text-dark">
                ₹{{ number_format($item->product->price * $item->quantity,2) }}
            </h5>
        </div>

        <div class="d-flex justify-content-between align-items-end mt-3">

            {{-- Update Quantity --}}
            <form action="{{ route('cart.update',$item->id) }}" method="POST">
                @csrf
                <div class="qty-container">
                    <input type="number"
                           name="quantity"
                           value="{{ $item->quantity }}"
                           min="1"
                           class="qty-input"
                           onchange="this.form.submit()">
                </div>
            </form>

            {{-- Remove Item --}}
            <form action="{{ route('cart.remove',$item->id) }}"
                  method="POST">
                @csrf
                @method('DELETE')
                <button class="btn-remove">
                    <i class="fas fa-trash-alt"></i> Remove
                </button>
            </form>

        </div>

    </div>
</div>

@empty

<div class="empty-state text-center py-5">
    <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
    <h4>Your Cart is Empty</h4>
    <a href="{{ url('/medicines') }}"
       class="btn btn-primary rounded-pill mt-3">
        Continue Shopping
    </a>
</div>

@endforelse

@if($cartItems->count() > 0)
<a href="{{ url('/medicines') }}"
   class="btn text-muted fw-bold mt-3 px-0">
    <i class="fas fa-arrow-left me-2"></i>
    Continue Shopping
</a>
@endif

</div>


{{-- ORDER SUMMARY --}}
@if($cartItems->count() > 0)
<div class="col-lg-4">
    <div class="summary-card">

        <h5 class="fw-bold mb-4">Order Summary</h5>

        <div class="summary-row">
            <span>Subtotal</span>
            <span class="fw-bold text-dark">
                ₹{{ number_format($subtotal,2) }}
            </span>
        </div>

        <div class="summary-row">
            <span>Tax (5%)</span>
            <span class="fw-bold text-dark">
                ₹{{ number_format($tax,2) }}
            </span>
        </div>

        <div class="summary-row">
            <span>Shipping</span>
            <span class="text-success fw-bold">Free</span>
        </div>

        <div class="summary-total">
            <span>Total</span>
            <span>
                ₹{{ number_format($total,2) }}
            </span>
        </div>

        {{-- Checkout --}}
        <form action="{{ route('checkout') }}" method="POST">
            @csrf
            <button class="btn btn-success w-100 rounded-pill py-3 fw-bold mt-4 shadow-lg">
                Proceed to Checkout
                <i class="fas fa-arrow-right ms-2"></i>
            </button>
        </form>

        <div class="text-center mt-3">
            <small class="text-muted">
                <i class="fas fa-lock me-1"></i> Secure Checkout
            </small>
        </div>

    </div>
</div>
@endif

</div>
</div>

@endsection