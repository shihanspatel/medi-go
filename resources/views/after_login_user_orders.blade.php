@extends('after_login_master_nav')

@section('title', 'My Orders - Medi-Go')

@section('styles')
<style>
    body {
        background-color: #f8fafc;
    }

    /* Page Header */
    .page-header {
        background: white;
        padding: 40px 0;
        border-bottom: 1px solid #e2e8f0;
        margin-bottom: 30px;
    }

    /* Order Tabs */
    .nav-pills .nav-link {
        color: #64748b;
        font-weight: 600;
        border-radius: 50px;
        padding: 8px 20px;
        margin-right: 10px;
        transition: 0.3s;
        border: 1px solid transparent;
    }

    .nav-pills .nav-link:hover {
        background: #f1f5f9;
        color: var(--dark);
    }

    .nav-pills .nav-link.active {
        background-color: var(--primary);
        color: white;
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.2);
    }

    /* Order Card */
    .order-card {
        background: white;
        border: 1px solid #f1f5f9;
        border-radius: 16px;
        overflow: hidden;
        transition: 0.3s;
        margin-bottom: 25px;
        position: relative;
    }

    .order-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.05);
        border-color: #e2e8f0;
    }

    /* Card Header */
    .order-header {
        background: #fcfcfc;
        border-bottom: 1px solid #f1f5f9;
        padding: 15px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .order-id {
        font-weight: 800;
        color: var(--dark);
        letter-spacing: 0.5px;
    }

    .order-date {
        font-size: 0.85rem;
        color: #94a3b8;
        font-weight: 600;
    }

    /* Card Body */
    .order-body {
        padding: 25px;
    }

    /* Product Thumbs */
    .product-thumbs {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
    }

    .thumb-img {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        border: 1px solid #f1f5f9;
        padding: 5px;
        object-fit: contain;
        background: white;
    }

    .more-items {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        background: #f8fafc;
        color: #64748b;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.9rem;
    }

    /* Status Badges */
    .status-badge {
        padding: 6px 12px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-delivered {
        background: #dcfce7;
        color: #166534;
    }

    .status-processing {
        background: #dbeafe;
        color: #1e40af;
    }

    .status-cancelled {
        background: #fee2e2;
        color: #991b1b;
    }

    .status-shipped {
        background: #ffedd5;
        color: #9a3412;
    }

    /* Footer / Actions */
    .order-footer {
        padding-top: 20px;
        border-top: 1px solid #f8fafc;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .total-price {
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--dark);
    }

    /* Search in Orders */
    .order-search {
        max-width: 300px;
    }

    .order-search .form-control {
        border-radius: 50px;
        padding-left: 20px;
        border-color: #e2e8f0;
    }

    .order-search .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.1);
    }

    @media (max-width: 768px) {

        .order-header,
        .order-footer {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .order-actions {
            width: 100%;
            display: flex;
            gap: 10px;
        }

        .order-actions .btn {
            flex: 1;
        }
    }
</style>
@endsection

@section('content')

<div class="page-header">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <div>
                <h2 class="fw-bold m-0 text-dark">My Orders</h2>
                <!-- <p class="text-muted m-0">Track, return, or buy items again.</p> -->
            </div>

            <div class="order-search w-100 w-md-auto">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search order ID or item...">
                    <button class="btn btn-dark rounded-pill px-4 ms-2 fw-bold">Search</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">

    <div class="order-card" data-aos="fade-up">
        <div class="order-header">
            <div class="d-flex align-items-center gap-3">
                <!-- <div class="d-flex flex-column">
                    <span class="text-muted small fw-bold text-uppercase">Order Placed</span>
                    <span class="order-date">Jan 28, 2026</span>
                </div>
                <div class="vr mx-2 opacity-25"></div> -->
                <div class="d-flex flex-column">
                    <span class="text-muted small fw-bold text-uppercase">Order ID</span>
                    <span class="order-id">#MG-88321</span>
                </div>
                </span>
            </div>
            <span class="status-badge status-delivered">
                    <i class="fas fa-check-circle me-1"></i> Delivered
        </div>
        <div class="order-body">
            <div class="row align-items-center">
                <div class="col-md-8 mb-3 mb-md-0">
                    <h6 class="fw-bold mb-3 text-secondary">Items in this order:</h6>
                    <div class="product-thumbs">
                        <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=100" class="thumb-img" alt="Med">
                        <img src="https://images.unsplash.com/photo-1550572017-edd951aa8f72?w=100" class="thumb-img" alt="Med">
                        <div class="more-items">+1</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bg-light p-3 rounded-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted small">Total Amount</span>
                            <span class="fw-bold">$42.50</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted small">Est. Delivery</span>
                            <span class="fw-bold text-success">Jan 30</span>
                        </div>
                        
                    </div>
                </div>
                <div class="order-footer">
                <div></div>
                <div class="order-actions">
                    <button class="btn btn-outline-dark rounded-pill btn-sm px-4 fw-bold">View Invoice</button>
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="order-card" data-aos="fade-up" data-aos-delay="100">
        <div class="order-header">
            <div class="d-flex align-items-center gap-3">
                <div class="d-flex flex-column">
                    <span class="text-muted small fw-bold text-uppercase">Order ID</span>
                    <span class="order-id">#MG-75402</span>
                </div>
            </div>
            <span class="status-badge status-delivered">
                <i class="fas fa-check-circle me-1"></i> Delivered
            </span>

        </div>
        <div class="order-body">
            <div class="row align-items-center">
                <div class="col-md-8 mb-3 mb-md-0">
                    <div class="product-thumbs">
                        <img src="https://images.unsplash.com/photo-1631549916768-4119b2d3f9e2?w=100" class="thumb-img" alt="Med">
                    </div>
                    <!-- <div class="small text-success mt-2 fw-bold"><i class="fas fa-home me-1"></i> Delivered to Front Porch</div> -->
                </div>
                <div class="col-md-4">
                    <div class="bg-light p-3 rounded-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted small">Total Amount</span>
                            <span class="fw-bold">$42.50</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted small">Est. Delivery</span>
                            <span class="fw-bold text-success">Jan 30</span>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="order-footer">
                <div></div>
                <div class="order-actions">
                    <button class="btn btn-outline-dark rounded-pill btn-sm px-4 fw-bold">View Invoice</button>
                </div>
            </div>
        </div>
    </div>

    <div class="order-card" data-aos="fade-up" data-aos-delay="200">
        <div class="order-header">
            <div class="d-flex align-items-center gap-3">
                <div class="d-flex flex-column">
                    <span class="text-muted small fw-bold text-uppercase">Order ID</span>
                    <span class="order-id">#MG-11029</span>
                </div>
            </div>
            <span class="status-badge status-cancelled">
                <i class="fas fa-times-circle me-1"></i> Cancelled
            </span>
        </div>
        <div class="order-body">
            <div class="row align-items-center">
                <div class="col-md-8 mb-3 mb-md-0">
                    <div class="product-thumbs opacity-50">
                        <img src="https://images.unsplash.com/photo-1585435557343-3b092031a831?w=100" class="thumb-img" alt="Med">
                        <img src="https://images.unsplash.com/photo-1628771065518-0d82f1938462?w=100" class="thumb-img" alt="Med">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bg-light p-3 rounded-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted small">Total Amount</span>
                            <span class="fw-bold">$42.50</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted small">Est. Delivery</span>
                            <span class="fw-bold text-success">Jan 30</span>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="order-footer">
                <div></div>
                <div class="order-actions">
                    <button class="btn btn-outline-dark rounded-pill btn-sm px-4 fw-bold">View Invoice</button>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <button class="btn btn-light rounded-pill px-4 text-muted fw-bold">Load More Orders</button>
    </div>

</div>

@endsection