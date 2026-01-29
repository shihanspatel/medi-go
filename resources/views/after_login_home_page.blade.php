@extends('after_login_master_nav')

@section('title', 'Medicines - Browse All')

@section('styles')

<style>
    /* Hero */
    .hero-section {
        padding: 100px 0;
        background: radial-gradient(circle at top right, #d1fae5 0%, #ffffff 50%);
        overflow: hidden;
    }

    .hero-btn {
        background: var(--primary);
        color: white;
        padding: 15px 35px;
        border-radius: 50px;
        font-weight: 700;
        border: none;
        transition: 0.3s;
    }

    .hero-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(5, 150, 105, 0.3);
    }

    .hero-img {
        animation: float 6s ease-in-out infinite;
        max-height: 450px;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    /* Category Cards */
    .category-card {
        background: white;
        border: 1px solid #e2e8f0;
        padding: 25px;
        border-radius: 20px;
        text-align: center;
        transition: 0.3s;
        cursor: pointer;
    }

    .category-card:hover {
        border-color: var(--primary);
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .cat-icon-box {
        width: 70px;
        height: 70px;
        background: #ecfdf5;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        color: var(--primary);
        font-size: 1.8rem;
        transition: 0.3s;
    }

    .category-card:hover .cat-icon-box {
        background: var(--primary);
        color: white;
    }

    /* Product Cards */
    .product-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        overflow: hidden;
        transition: 0.4s;
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
        border-color: var(--primary);
    }

    .prod-img-box {
        height: 200px;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .prod-img {
        height: 140px;
        transition: 0.5s;
    }

    .product-card:hover .prod-img {
        transform: scale(1.1);
    }

    .add-btn {
        width: 100%;
        border: 1px solid var(--primary);
        color: var(--primary);
        background: transparent;
        padding: 10px;
        border-radius: 10px;
        font-weight: 700;
        transition: 0.3s;
    }

    .add-btn:hover {
        background: var(--primary);
        color: white;
    }
</style>

@endsection

@section('content')
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                <span class="badge bg-success bg-opacity-10 text-success border border-success mb-3 px-3 py-2 rounded-pill">
                    <i class="fas fa-check-circle me-1"></i> #1 Rated Pharmacy
                </span>
                <h1 class="display-4 fw-bold mb-3">Healthcare at your <br><span style="color: var(--primary);">Fingertips.</span></h1>
                <p class="lead text-secondary mb-4">Genuine medicines, vitamins, and personal care products delivered within 24 hours.</p>
                <div class="d-flex gap-3">
                    <button class="hero-btn shadow-lg"><i class="fas fa-shopping-cart me-2"></i>Order Now</button>
                </div>
            </div>
            <div class="col-lg-6 text-center" data-aos="fade-left">
                <img src="https://cdni.iconscout.com/illustration/premium/thumb/online-medicine-delivery-4501625-3736768.png" class="hero-img img-fluid" alt="Pharmacy">
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Shop by Category</h3>
        </div>
        <div class="row g-4">
            <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="100">
                <a href="{{ url('/medicines_') }}" class="text-decoration-none">
                    <div class="category-card">
                        <div class="cat-icon-box"><i class="fas fa-pills"></i></div>
                        <h6 class="fw-bold text-dark">Medicines</h6>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="200">
                <a href="{{ url('/baby_care_') }}" class="text-decoration-none">
                    <div class="category-card">
                        <div class="cat-icon-box"><i class="fas fa-baby-carriage"></i></div>
                        <h6 class="fw-bold text-dark">Baby Care</h6>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="300">
                <a href="{{ url('/devices_') }}" class="text-decoration-none">
                    <div class="category-card">
                        <div class="cat-icon-box"><i class="fas fa-heartbeat"></i></div>
                        <h6 class="fw-bold text-dark">Devices</h6>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="400">
                <a href="{{ url('/nutration_') }}" class="text-decoration-none">
                    <div class="category-card">
                        <div class="cat-icon-box"><i class="fas fa-carrot"></i></div>
                        <h6 class="fw-bold text-dark">Nutrition</h6>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <h2 class="fw-bold text-center mb-5">Trending Essentials</h2>
        <div class="row g-4">
            <div class="col-md-3 col-6" data-aos="fade-up">
                <div class="product-card">
                    <div class="prod-img-box">
                        <span class="badge bg-danger position-absolute top-0 start-0 m-3">10% OFF</span>
                        <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&q=80&w=400" class="prod-img" alt="Med">
                    </div>
                    <div class="p-3">
                        <small class="text-muted"><i class="fas fa-tag me-1"></i>Pain Relief</small>
                        <h6 class="fw-bold mt-1">Paracetamol 500mg</h6>
                        <div class="d-flex justify-content-between align-items-center my-3">
                            <span class="h5 fw-bold mb-0 text-dark">$2.50</span>
                            <small class="text-decoration-line-through text-muted">$3.00</small>
                        </div>
                        <button class="add-btn"><i class="fas fa-cart-plus me-1"></i> Add</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="100">
                <div class="product-card">
                    <div class="prod-img-box">
                        <img src="https://images.unsplash.com/photo-1626804475297-411dbe64afc9?auto=format&fit=crop&q=80&w=400" class="prod-img" alt="Syrup">
                    </div>
                    <div class="p-3">
                        <small class="text-muted"><i class="fas fa-tag me-1"></i>Syrup</small>
                        <h6 class="fw-bold mt-1">Cough Syrup</h6>
                        <div class="d-flex justify-content-between align-items-center my-3">
                            <span class="h5 fw-bold mb-0 text-dark">$8.99</span>
                        </div>
                        <button class="add-btn"><i class="fas fa-cart-plus me-1"></i> Add</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="200">
                <div class="product-card">
                    <div class="prod-img-box">
                        <img src="https://images.unsplash.com/photo-1550572017-edd951aa8f72?auto=format&fit=crop&q=80&w=400" class="prod-img" alt="Vitamins">
                    </div>
                    <div class="p-3">
                        <small class="text-muted"><i class="fas fa-tag me-1"></i>Wellness</small>
                        <h6 class="fw-bold mt-1">Vitamin C + Zinc</h6>
                        <div class="d-flex justify-content-between align-items-center my-3">
                            <span class="h5 fw-bold mb-0 text-dark">$14.00</span>
                        </div>
                        <button class="add-btn"><i class="fas fa-cart-plus me-1"></i> Add</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="300">
                <div class="product-card">
                    <div class="prod-img-box">
                        <img src="https://images.unsplash.com/photo-1583947215259-38e31be8751f?auto=format&fit=crop&q=80&w=400" class="prod-img" alt="Device">
                    </div>
                    <div class="p-3">
                        <small class="text-muted"><i class="fas fa-tag me-1"></i>Devices</small>
                        <h6 class="fw-bold mt-1">Digital Thermometer</h6>
                        <div class="d-flex justify-content-between align-items-center my-3">
                            <span class="h5 fw-bold mb-0 text-dark">$25.00</span>
                        </div>
                        <button class="add-btn"><i class="fas fa-cart-plus me-1"></i> Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection