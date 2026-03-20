@extends('master_nav')

@section('title', 'Shopping Cart - Medi-Go')

@section('styles')
<style>
    :root {
        --primary: #059669;
        --primary-dark: #047857;
        --success: #10b981;
    }

    body {
        background: linear-gradient(135deg, #f0fdf4 0%, #f8fafc 100%);
    }

    .page-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--success) 100%);
        color: white;
        padding: 40px 0;
        margin-bottom: 40px;
        border-radius: 0 0 30px 30px;
    }

    .page-header h2 {
        font-weight: 800;
        font-size: 2rem;
        margin-bottom: 10px;
    }

    .page-header p {
        opacity: 0.9;
        font-size: 1.1rem;
    }

    /* CART ITEM */

    .cart-item {
        display: flex;
        gap: 20px;
        background: white;
        padding: 25px;
        border-radius: 18px;
        border: 2px solid #e5e7eb;
        margin-bottom: 20px;
        align-items: center;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .cart-item:hover {
        box-shadow: 0 15px 35px rgba(5, 150, 105, 0.1);
        border-color: var(--primary);
        transform: translateY(-2px);
    }

    /* IMAGE */

    .item-img-box {
        width: 110px;
        height: 110px;
        background: linear-gradient(135deg, #f0fdf4 0%, #f8fafc 100%);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        flex-shrink: 0;
    }

    .item-img {
        max-width: 90px;
        max-height: 90px;
        object-fit: contain;
    }

    /* ITEM DETAILS */

    .item-details {
        flex-grow: 1;
    }

    .item-name {
        font-weight: 700;
        font-size: 1.1rem;
        color: #1f2937;
        margin-bottom: 8px;
    }

    .item-price {
        color: var(--primary);
        font-weight: 700;
        font-size: 1.2rem;
        margin-bottom: 12px;
    }

    .item-meta {
        display: flex;
        gap: 20px;
        font-size: 0.9rem;
        color: #64748b;
    }

    /* QUANTITY CONTROL */

    .qty-container {
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        overflow: hidden;
        width: 100px;
        display: flex;
        align-items: center;
        background: white;
        transition: all 0.3s ease;
    }

    .qty-container:hover {
        border-color: var(--primary);
    }

    .qty-btn {
        width: 33.33%;
        border: none;
        background: none;
        cursor: pointer;
        color: var(--primary);
        font-weight: 700;
        transition: all 0.2s ease;
    }

    .qty-btn:hover {
        background: #f0fdf4;
    }

    .qty-input {
        width: 33.33%;
        border: none;
        text-align: center;
        padding: 8px 0;
        outline: none;
        font-weight: 700;
        background: transparent;
        color: #1f2937;
    }

    /* REMOVE BUTTON */

    .btn-remove {
        background: #fee2e2;
        color: #dc2626;
        border: none;
        padding: 10px 16px;
        border-radius: 10px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .btn-remove:hover {
        background: #fecaca;
        transform: translateY(-2px);
    }

    /* EMPTY STATE */

    .empty-state {
        background: white;
        border-radius: 20px;
        padding: 60px 40px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .empty-icon {
        font-size: 4rem;
        color: #cbd5e1;
        margin-bottom: 20px;
    }

    .empty-state h4 {
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #64748b;
        margin-bottom: 25px;
    }

    .continue-shopping-btn {
        background: linear-gradient(135deg, var(--primary) 0%, var(--success) 100%);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 700;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .continue-shopping-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(5, 150, 105, 0.3);
    }

    /* ORDER SUMMARY */

    .summary-card {
        background: white;
        border-radius: 18px;
        padding: 30px;
        border: 2px solid #e5e7eb;
        position: sticky;
        top: 100px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .summary-card h5 {
        font-weight: 800;
        margin-bottom: 25px;
        color: #1f2937;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        color: #64748b;
        font-weight: 500;
    }

    .summary-row span:last-child {
        color: #1f2937;
        font-weight: 700;
    }

    .summary-divider {
        border-top: 2px solid #e5e7eb;
        margin: 20px 0;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        font-size: 1.3rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 25px;
    }

    .summary-total .amount {
        color: var(--primary);
    }

    .checkout-btn {
        width: 100%;
        background: linear-gradient(135deg, var(--primary) 0%, var(--success) 100%);
        color: white;
        border: none;
        padding: 14px 20px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 10px 25px rgba(5, 150, 105, 0.3);
    }

    .checkout-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(5, 150, 105, 0.4);
    }

    .checkout-btn:active {
        transform: translateY(0);
    }

    .security-badge {
        text-align: center;
        margin-top: 15px;
        color: #64748b;
        font-size: 0.9rem;
    }

    .security-badge i {
        color: var(--primary);
        margin-right: 6px;
    }

    /* CONTINUE SHOPPING LINK */

    .continue-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary);
        text-decoration: none;
        font-weight: 700;
        margin-top: 20px;
        transition: all 0.3s ease;
    }

    .continue-link:hover {
        gap: 12px;
    }

    /* RESPONSIVE */

    @media (max-width: 768px) {
        .page-header h2 {
            font-size: 1.5rem;
        }

        .cart-item {
            flex-direction: column;
            gap: 15px;
        }

        .item-img-box {
            width: 100%;
            height: 150px;
        }

        .summary-card {
            position: static;
            margin-top: 30px;
        }

        .item-meta {
            flex-wrap: wrap;
        }
    }
</style>
@endsection

@section('content')

<div class="page-header">
    <div class="container">
        <h2><i class="fas fa-shopping-cart me-2"></i>Shopping Cart</h2>
        <p id="cartCount">{{ $cartItems->count() }} item{{ $cartItems->count() !== 1 ? 's' : '' }} in your cart</p>
    </div>
</div>

<div class="container pb-5">
    <div class="row g-4">

        {{-- CART ITEMS --}}
        <div class="col-lg-8">

            @forelse($cartItems as $item)

            <div class="cart-item">

                <div class="item-img-box">
                    <img src="{{ asset('images/product_Images/'.$item->product->image) }}"
                        class="item-img"
                        alt="{{ $item->product->name }}">
                </div>

                <div class="item-details">

                    <div class="item-name">
                        {{ $item->product->name }}
                    </div>

                    <div class="item-price">
                        ₹{{ number_format($item->product->price, 2) }} each
                    </div>

                    <div class="item-meta">
                        <span><i class="fas fa-check-circle text-success me-1"></i>In Stock</span>
                        <span><i class="fas fa-star text-warning me-1"></i>{{ number_format($item->product->averageRating(), 1) }} ({{ $item->product->ratingCount() }} reviews)</span>
                    </div>

                </div>

                <div class="d-flex align-items-center gap-3">

                    {{-- Update Quantity --}}
                    <form action="{{ route('cart.update',$item->id) }}" method="POST">
                        @csrf
                        <div class="qty-container">
                            <button type="button" class="qty-btn" onclick="decrementQty(this)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number"
                                name="quantity"
                                class="qty-input"
                                value="{{ $item->quantity }}"
                                min="1"
                                onchange="this.form.submit()">
                            <button type="button" class="qty-btn" onclick="incrementQty(this)">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </form>

                    <div style="min-width: 100px; text-align: right;">
                        <div style="font-weight: 700; color: var(--primary); font-size: 1.1rem;">
                            ₹{{ number_format($item->product->price * $item->quantity, 2) }}
                        </div>
                        <div style="font-size: 0.85rem; color: #64748b;">
                            {{ $item->quantity }} × ₹{{ number_format($item->product->price, 2) }}
                        </div>
                    </div>

                    {{-- Remove Item --}}
                    <form action="{{ route('cart.remove',$item->id) }}" method="POST" onsubmit="return confirmDelete('Remove this item from cart?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-remove">
                            <i class="fas fa-trash-alt me-1"></i>Remove
                        </button>
                    </form>

                </div>

            </div>

            @empty

            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <h4>Your Cart is Empty</h4>
                <p>Start adding medicines to your cart and get them delivered to your doorstep!</p>
                <a href="{{ route('home.index') }}" class="continue-shopping-btn">
                    <i class="fas fa-shopping-bag me-2"></i>Browse Medicines
                </a>
            </div>

            @endforelse

            @if($cartItems->count() > 0)
            <a href="{{ route('home.index') }}" class="continue-link">
                <i class="fas fa-arrow-left"></i> Continue Shopping
            </a>
            @endif

        </div>


        {{-- ORDER SUMMARY --}}
        @if($cartItems->count() > 0)
        <div class="col-lg-4">
            <div class="summary-card">

                <h5>Order Summary</h5>

                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>₹{{ number_format($subtotal, 2) }}</span>
                </div>

                <div class="summary-row">
                    <span>Tax (5%)</span>
                    <span>₹{{ number_format($tax, 2) }}</span>
                </div>

                <div class="summary-row">
                    <span>Shipping</span>
                    <span class="text-success">Free</span>
                </div>

                <div class="summary-divider"></div>

                <div class="summary-total">
                    <span>Total</span>
                    <span class="amount">₹{{ number_format($total, 2) }}</span>
                </div>

                {{-- Checkout --}}
                <button id="checkout-btn" class="checkout-btn">
                    <i class="fas fa-lock me-2"></i>Proceed to Checkout
                </button>

                <div class="security-badge">
                    <i class="fas fa-shield-alt"></i> Secure Checkout
                </div>

                <div style="margin-top: 20px; padding-top: 20px; border-top: 2px solid #e5e7eb; text-align: center; color: #64748b; font-size: 0.9rem;">
                    <p style="margin: 0;">
                        <i class="fas fa-truck text-success me-2"></i>Free delivery on orders above ₹500
                    </p>
                    <p style="margin: 8px 0 0 0;">
                        <i class="fas fa-undo text-info me-2"></i>Easy returns within 7 days
                    </p>
                </div>

            </div>
        </div>
        @endif

    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
<script>
    function incrementQty(btn) {
        const input = btn.parentElement.querySelector('.qty-input');
        input.value = parseInt(input.value) + 1;
        input.form.submit();
    }

    function decrementQty(btn) {
        const input = btn.parentElement.querySelector('.qty-input');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
            input.form.submit();
        }
    }

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
                                alert('Payment verification failed: ' + (result.message || 'Unknown error'));
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
                alert('Error creating order: ' + (data.message || 'Unknown error'));
                console.error('Checkout error:', data);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Something went wrong: ' + error.message);
        });
    });
</script>

@endsection
