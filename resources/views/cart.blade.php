@extends('master_nav')

@section('title', 'Shopping Cart - Medi-Go')

@section('styles')
<style>
    :root {
        --primary: #059669;
        --primary-dark: #047857;
    }

    /* PAGE HEADER */

    .page-header-bg {
        background: #f1f5f9;
        padding: 25px 0;
        margin-bottom: 30px;
        border-bottom: 1px solid #e2e8f0;
    }

    /* CART ITEM */

    .cart-item {
        display: flex;
        gap: 20px;
        background: white;
        padding: 20px;
        border-radius: 15px;
        border: 1px solid #e5e7eb;
        margin-bottom: 20px;
        align-items: center;
        transition: .3s;
    }

    .cart-item:hover {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        border-color: var(--primary);
    }

    /* IMAGE */

    .item-img-box {
        width: 90px;
        height: 90px;
        background: #f8fafc;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .item-img {
        max-width: 70px;
    }

    /* QUANTITY */

    .qty-container {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        overflow: hidden;
        width: 70px;
    }

    .qty-input {
        width: 100%;
        border: none;
        text-align: center;
        padding: 6px;
        outline: none;
    }

    /* REMOVE BUTTON */

    .btn-remove {
        background: none;
        border: none;
        color: #ef4444;
        font-weight: 600;
    }

    .btn-remove:hover {
        text-decoration: underline;
    }

    /* EMPTY STATE */

    .empty-state {
        background: white;
        border: 1px dashed #cbd5e1;
        border-radius: 15px;
    }

    /* ORDER SUMMARY */

    .summary-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        border: 1px solid #e5e7eb;
        position: sticky;
        top: 90px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        color: #64748b;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px solid #e5e7eb;
        font-size: 1.3rem;
        font-weight: 700;
        color: #111827;
    }
</style>
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
                <button id="checkout-btn" class="btn btn-success w-100 rounded-pill py-3 fw-bold mt-4 shadow-lg">
                    Proceed to Checkout
                    <i class="fas fa-arrow-right ms-2"></i>
                </button>

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

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
<script>
    function fireConfetti() {
        confetti({
            particleCount: 100,
            spread: 70,
            origin: { x: 0, y: 0.6 }
        });
        confetti({
            particleCount: 100,
            spread: 70,
            origin: { x: 1, y: 0.6 }
        });
    }

    document.getElementById('checkout-btn').addEventListener('click', function(e) {
        e.preventDefault();
        
        fetch('{{ route("checkout") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                var options = {
                    "key": data.key,
                    "amount": data.amount,
                    "currency": "INR",
                    "name": "Medi-Go",
                    "order_id": data.razorpay_order_id,
                    "handler": function(response) {
                        fetch('{{ route("payment.verify") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                razorpay_order_id: response.razorpay_order_id,
                                razorpay_payment_id: response.razorpay_payment_id,
                                razorpay_signature: response.razorpay_signature
                            })
                        })
                        .then(res => res.json())
                        .then(result => {
                            if (result.success) {
                                fireConfetti();
                                setTimeout(() => {
                                    window.location.href = '{{ route("orders.index") }}';
                                }, 1500);
                            } else {
                                alert('Payment verification failed');
                            }
                        });
                    },
                    "prefill": {
                        "name": "{{ auth()->user()->name }}",
                        "email": "{{ auth()->user()->email }}"
                    },
                    "theme": {
                        "color": "#059669"
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.open();
            } else {
                alert('Error creating order');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Something went wrong');
        });
    });
</script>

@endsection
