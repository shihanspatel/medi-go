@extends('after_login_master_nav')

@section('title', 'My Wishlist - Medi-Go')

@section('styles')
<style>
    body { background-color: #f8fafc; }

    /* --- Premium Header --- */
    .wishlist-header {
        background: white;
        padding: 60px 0;
        border-bottom: 1px solid #e2e8f0;
        position: relative;
        overflow: hidden;
    }
    .wishlist-header::after {
        content: ''; position: absolute; top: -50px; right: -50px; width: 200px; height: 200px;
        background: var(--primary); opacity: 0.05; border-radius: 50%;
    }

    /* --- Action Toolbar --- */
    .wishlist-toolbar {
        background: white;
        border: 1px solid #f1f5f9;
        border-radius: 16px;
        padding: 15px 25px;
        margin-top: -35px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 10;
        position: relative;
    }

    /* --- Premium Wishlist Card --- */
    .premium-wish-card {
        background: white;
        border-radius: 24px;
        border: 1px solid #f1f5f9;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        height: 100%;
        position: relative;
    }
    .premium-wish-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        border-color: var(--primary);
    }

    /* Image Wrapper & Overlay */
    .img-container {
        height: 220px;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        padding: 20px;
        overflow: hidden;
    }
    .wish-img { max-height: 150px; transition: 0.5s; }
    .premium-wish-card:hover .wish-img { transform: scale(1.1); }

    /* Floating Badges */
    .badge-float {
        position: absolute; top: 15px; left: 15px; z-index: 5;
        font-size: 0.65rem; font-weight: 800; padding: 5px 10px; border-radius: 50px;
    }
    .badge-price-drop { background: #fee2e2; color: #ef4444; border: 1px solid #fca5a5; }

    /* Action Buttons Overlay */
    .card-actions {
        position: absolute; bottom: -50px; left: 0; right: 0; padding: 15px;
        background: rgba(255,255,255,0.9); backdrop-filter: blur(5px);
        transition: 0.3s; opacity: 0; display: flex; gap: 10px;
    }
    .premium-wish-card:hover .card-actions { bottom: 0; opacity: 1; }

    /* Card Details */
    .wish-content { padding: 20px; text-align: center; }
    .wish-cat { font-size: 0.7rem; font-weight: 800; color: var(--primary); text-transform: uppercase; letter-spacing: 1px; }
    .wish-title { font-weight: 700; color: var(--dark); margin: 5px 0; font-size: 1.05rem; }
    
    .rating-stars { color: #fbbf24; font-size: 0.8rem; margin-bottom: 10px; }
    
    .price-wrap { font-size: 1.25rem; font-weight: 800; color: var(--dark); }
    .old-price { font-size: 0.9rem; color: #94a3b8; text-decoration: line-through; margin-right: 5px; }

    /* --- Recommendations Section --- */
    .recom-section { margin-top: 80px; padding-top: 50px; border-top: 1px solid #e2e8f0; }

</style>
@endsection

@section('content')

    <div class="wishlist-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <h1 class="fw-bold display-5 mb-2">My Wishlist</h1>
                    <p class="text-muted lead mb-0">Items you’ve saved for a healthier tomorrow.</p>
                </div>
                <div class="col-md-6 text-center text-md-end d-none d-md-block">
                    <div class="d-inline-flex align-items-center bg-light p-3 rounded-4">
                        <div class="text-start me-3">
                            <small class="text-muted d-block fw-bold">TOTAL VALUE</small>
                            <span class="h4 fw-bold text-dark m-0">$124.50</span>
                        </div>
                        <i class="fas fa-heart text-danger fa-2x opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container pb-5">

        <div class="row g-4">
            
            <div class="col-md-4 col-lg-3" data-aos="fade-up">
                <div class="premium-wish-card">
                    <span class="badge-float badge-price-drop"><i class="fas fa-arrow-down me-1"></i> PRICE DROPPED</span>
                    <div class="img-container">
                        <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=300" class="wish-img" alt="Med">
                        <div class="card-actions">
                            <button class="btn btn-success flex-grow-1 rounded-pill btn-sm fw-bold shadow-sm">Add to Cart</button>
                            <button class="btn btn-light rounded-circle btn-sm border" title="Remove"><i class="fas fa-trash-alt text-danger"></i></button>
                        </div>
                    </div>
                    <div class="wish-content">
                        <span class="wish-cat">Pain Relief</span>
                        <h6 class="wish-title">Paracetamol 500mg</h6>
                        <div class="rating-stars">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                            <span class="text-muted small ms-1">(4.5)</span>
                        </div>
                        <div class="price-wrap">
                            <span class="old-price">$7.00</span> $5.00
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="premium-wish-card">
                    <div class="img-container">
                        <img src="https://images.unsplash.com/photo-1550572017-edd951aa8f72?w=300" class="wish-img" alt="Med">
                        <div class="card-actions">
                            <button class="btn btn-success flex-grow-1 rounded-pill btn-sm fw-bold shadow-sm">Add to Cart</button>
                            <button class="btn btn-light rounded-circle btn-sm border"><i class="fas fa-trash-alt text-danger"></i></button>
                        </div>
                    </div>
                    <div class="wish-content">
                        <span class="wish-cat">Wellness</span>
                        <h6 class="wish-title">Vitamin C + Zinc</h6>
                        <div class="rating-stars">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <div class="price-wrap">$15.00</div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="premium-wish-card opacity-75">
                    <div class="img-container grayscale">
                        <span class="badge bg-secondary position-absolute rounded-pill fw-bold" style="font-size: 0.7rem; top: 15px; right: 15px;">OUT OF STOCK</span>
                        <img src="https://images.unsplash.com/photo-1583947215259-38e31be8751f?w=300" class="wish-img" alt="Med">
                        <div class="card-actions">
                            <button class="btn btn-dark flex-grow-1 rounded-pill btn-sm fw-bold shadow-sm">Notify Me</button>
                            <button class="btn btn-light rounded-circle btn-sm border"><i class="fas fa-trash-alt text-danger"></i></button>
                        </div>
                    </div>
                    <div class="wish-content">
                        <span class="wish-cat">Devices</span>
                        <h6 class="wish-title">Digital Thermometer</h6>
                        <div class="rating-stars">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                        </div>
                        <div class="price-wrap text-muted">$25.00</div>
                    </div>
                </div>
            </div>

             <div class="col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="premium-wish-card">
                    <div class="img-container">
                        <img src="https://images.unsplash.com/photo-1628771065518-0d82f1938462?w=300" class="wish-img" alt="Med">
                        <div class="card-actions">
                            <button class="btn btn-success flex-grow-1 rounded-pill btn-sm fw-bold shadow-sm">Add to Cart</button>
                            <button class="btn btn-light rounded-circle btn-sm border"><i class="fas fa-trash-alt text-danger"></i></button>
                        </div>
                    </div>
                    <div class="wish-content">
                        <span class="wish-cat">Personal Care</span>
                        <h6 class="wish-title">Antiseptic Cream</h6>
                        <div class="rating-stars">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <div class="price-wrap">$12.50</div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection