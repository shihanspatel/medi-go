@extends('master_nav')

@section('title', 'Medi-Go - Home')

@section('styles')
<style>
/* ================= HERO ================= */
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
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
}

/* ================= CATEGORY ================= */
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

/* ================= PRODUCT ================= */
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

{{-- ================= HERO SECTION ================= --}}
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">

                <span class="badge bg-success bg-opacity-10 text-success border border-success mb-3 px-3 py-2 rounded-pill">
                    <i class="fas fa-check-circle me-1"></i> {{ $banner->badge_text }}
                </span>

                <h1 class="display-4 fw-bold mb-3">
                    {{ $banner->heading }} <br>
                    <span style="color: var(--primary);">{{ $banner->highlight_text }}</span>
                </h1>

                <p class="lead text-secondary mb-4">
                    {{ $banner->description }}
                </p>

                <button class="hero-btn shadow-lg">
                    <i class="fas fa-shopping-cart me-2"></i>
                    {{ $banner->button_text }}
                </button>

            </div>

            <div class="col-lg-6 text-center" data-aos="fade-left">
                <img src="{{ asset('uploads/banners/'.$banner->image) }}"
                     class="hero-img img-fluid" alt="Banner">
            </div>

        </div>
    </div>
</section>


{{-- ================= CATEGORIES ================= --}}
<section class="py-5">
    <div class="container">
        <h3 class="fw-bold mb-4">Shop by Category</h3>

        <div class="row g-4">
            @foreach($categories as $category)
            <div class="col-6 col-md-3" data-aos="zoom-in">
                <a href="{{ url('/category/'.$category->slug) }}" class="text-decoration-none">
                    <div class="category-card">
                        <div class="cat-icon-box">
                            <i class="fas {{ $category->icon }}"></i>
                        </div>
                        <h6 class="fw-bold text-dark">{{ $category->name }}</h6>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= TRENDING PRODUCTS ================= --}}
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="fw-bold text-center mb-5">Trending Essentials</h2>

        <div class="row g-4">
            @foreach($products as $product)
            <div class="col-md-3 col-6" data-aos="fade-up">
                <div class="product-card">

                    <div class="prod-img-box">
                        @if($product->discount)
                        <span class="badge bg-danger position-absolute top-0 start-0 m-3">
                            {{ $product->discount }}% OFF
                        </span>
                        @endif

                        <img src="{{ asset('uploads/products/'.$product->image) }}"
                             class="prod-img" alt="{{ $product->name }}">
                    </div>

                    <div class="p-3">
                        <small class="text-muted">
                            <i class="fas fa-tag me-1"></i>{{ $product->category }}
                        </small>

                        <h6 class="fw-bold mt-1">{{ $product->name }}</h6>

                        <div class="d-flex justify-content-between align-items-center my-3">
                            <span class="h5 fw-bold mb-0 text-dark">
                                ₹{{ $product->price }}
                            </span>

                            @if($product->old_price)
                            <small class="text-decoration-line-through text-muted">
                                ₹{{ $product->old_price }}
                            </small>
                            @endif
                        </div>

                        <button class="add-btn">
                            <i class="fas fa-cart-plus me-1"></i> Add
                        </button>
                    </div>

                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
