@extends('after_login_master_nav')

@section('title', 'Shopping Cart - Medi-Go')

@section('styles')
<style>
    body { background-color: #f8fafc; }

    /* --- Page Header --- */
    .page-header-bg {
        background: radial-gradient(circle at top right, #d1fae5 0%, #ffffff 60%);
        padding: 50px 0 30px;
        margin-bottom: 30px;
    }

    /* --- Cart Item Card --- */
    .cart-item {
        background: white;
        border: 1px solid #f1f5f9;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        transition: 0.3s;
    }
    .cart-item:hover {
        border-color: #d1fae5;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }
    
    .item-img-box {
        width: 100px;
        height: 100px;
        background: #f8fafc;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        flex-shrink: 0;
    }
    .item-img {
        max-width: 80%;
        max-height: 80%;
        object-fit: contain;
    }

    /* Quantity Stepper */
    .qty-container {
        display: flex;
        align-items: center;
        background: #f1f5f9;
        border-radius: 50px;
        padding: 5px;
        width: fit-content;
    }
    .qty-btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: none;
        background: white;
        color: var(--dark);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 0.8rem;
        transition: 0.2s;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .qty-btn:hover { background: var(--primary); color: white; }
    .qty-input {
        width: 40px;
        border: none;
        background: transparent;
        text-align: center;
        font-weight: 700;
        font-size: 0.9rem;
        color: var(--dark);
    }
    .qty-input:focus { outline: none; }

    /* Remove Button */
    .btn-remove {
        color: #94a3b8;
        font-size: 0.9rem;
        text-decoration: none;
        transition: 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-weight: 600;
        margin-top: 10px;
    }
    .btn-remove:hover { color: #ef4444; }

    /* --- Summary Card (Sticky) --- */
    .summary-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 10px 40px rgba(0,0,0,0.04);
        position: sticky;
        top: 100px; /* Sticks below navbar */
    }
    
    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        font-size: 0.95rem;
        color: #64748b;
    }
    .summary-total {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px dashed #f1f5f9;
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--dark);
    }

    /* Coupon Input */
    .coupon-box {
        position: relative;
        margin-bottom: 20px;
    }
    .coupon-input {
        padding: 12px 100px 12px 20px;
        border-radius: 12px;
        border: 2px solid #f1f5f9;
        width: 100%;
        font-weight: 600;
        outline: none;
        transition: 0.3s;
    }
    .coupon-input:focus { border-color: var(--primary); }
    .btn-apply {
        position: absolute;
        right: 5px;
        top: 5px;
        bottom: 5px;
        border-radius: 8px;
        background: var(--dark);
        color: white;
        border: none;
        padding: 0 15px;
        font-weight: 700;
        font-size: 0.8rem;
    }

    /* Empty Cart State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    .empty-icon {
        font-size: 4rem;
        color: #e2e8f0;
        margin-bottom: 20px;
    }

    /* Mobile adjustments */
    @media (max-width: 768px) {
        .cart-item { flex-direction: column; align-items: flex-start; }
        .item-img-box { margin-bottom: 15px; width: 100%; height: 150px; }
        .item-details-row { width: 100%; display: flex; justify-content: space-between; align-items: center; margin-top: 15px; }
    }
</style>
@endsection

@section('content')

    <div class="page-header-bg">
        <div class="container">
            <h2 class="fw-bold text-dark m-0">Your Cart <span class="text-secondary fw-normal h4">(3 Items)</span></h2>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row g-4">
            
            <div class="col-lg-8">
                
                <div class="cart-item" data-aos="fade-up">
                    <div class="item-img-box">
                        <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=150" class="item-img" alt="Product">
                    </div>
                    <div class="flex-grow-1 w-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Paracetamol 500mg</h6>
                                <p class="text-muted small mb-0">Pack of 20 Tablets</p>
                                <span class="badge bg-success bg-opacity-10 text-success mt-2">In Stock</span>
                            </div>
                            <h5 class="fw-bold text-dark">$5.00</h5>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-end mt-3">
                            <div class="qty-container">
                                <button class="qty-btn"><i class="fas fa-minus"></i></button>
                                <input type="text" value="2" class="qty-input" readonly>
                                <button class="qty-btn"><i class="fas fa-plus"></i></button>
                            </div>
                            <a href="#" class="btn-remove"><i class="fas fa-trash-alt"></i> Remove</a>
                        </div>
                    </div>
                </div>

                <div class="cart-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="item-img-box">
                        <img src="https://images.unsplash.com/photo-1550572017-edd951aa8f72?w=150" class="item-img" alt="Product">
                    </div>
                    <div class="flex-grow-1 w-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Vitamin C + Zinc</h6>
                                <p class="text-muted small mb-0">Immunity Booster - 60 Tabs</p>
                            </div>
                            <h5 class="fw-bold text-dark">$15.00</h5>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-end mt-3">
                            <div class="qty-container">
                                <button class="qty-btn"><i class="fas fa-minus"></i></button>
                                <input type="text" value="1" class="qty-input" readonly>
                                <button class="qty-btn"><i class="fas fa-plus"></i></button>
                            </div>
                            <a href="#" class="btn-remove"><i class="fas fa-trash-alt"></i> Remove</a>
                        </div>
                    </div>
                </div>

                <div class="cart-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="item-img-box">
                        <img src="https://images.unsplash.com/photo-1631549916768-4119b2d3f9e2?w=150" class="item-img" alt="Product">
                    </div>
                    <div class="flex-grow-1 w-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Benadryl Cough Syrup</h6>
                                <p class="text-muted small mb-0">150ml Bottle</p>
                            </div>
                            <h5 class="fw-bold text-dark">$8.50</h5>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-end mt-3">
                            <div class="qty-container">
                                <button class="qty-btn"><i class="fas fa-minus"></i></button>
                                <input type="text" value="1" class="qty-input" readonly>
                                <button class="qty-btn"><i class="fas fa-plus"></i></button>
                            </div>
                            <a href="#" class="btn-remove"><i class="fas fa-trash-alt"></i> Remove</a>
                        </div>
                    </div>
                </div>

                <a href="{{ url('/medicines') }}" class="btn text-muted fw-bold mt-3 px-0">
                    <i class="fas fa-arrow-left me-2"></i> Continue Shopping
                </a>

            </div>

            <div class="col-lg-4">
                <div class="summary-card">
                    <h5 class="fw-bold mb-4">Order Summary</h5>
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span class="fw-bold text-dark">$33.50</span>
                    </div>
                    <div class="summary-row">
                        <span>Tax (5%)</span>
                        <span class="fw-bold text-dark">$1.67</span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping</span>
                        <span class="text-success fw-bold">Free</span>
                    </div>

                    <div class="summary-total">
                        <span>Total</span>
                        <span>$35.17</span>
                    </div>

                    <button class="btn btn-success w-100 rounded-pill py-3 fw-bold mt-4 shadow-lg">
                        Proceed to Checkout <i class="fas fa-arrow-right ms-2"></i>
                    </button>

                    <div class="text-center mt-3">
                        <small class="text-muted"><i class="fas fa-lock me-1"></i> Secure Checkout</small>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection