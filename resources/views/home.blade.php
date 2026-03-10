@extends('master_nav')

@section('title', 'Medi-Go - Home')

@section('styles')
<style>
    :root {
        --primary: #059669;
        --primary-dark: #047857;
    }

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
        display: inline-block;
        text-decoration: none;
    }

    .hero-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(5, 150, 105, 0.3);
        color: white;
    }

    .hero-img {
        animation: float 6s ease-in-out infinite;
        max-height: 450px;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }

    .category-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        padding: 30px 20px;
        border-radius: 16px;
        text-align: center;
        transition: 0.3s ease;
        height: 100%;
    }

    .category-card:hover {
        transform: translateY(-6px);
        border-color: var(--primary);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.06);
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
        font-size: 1.6rem;
        color: var(--primary);
        transition: 0.3s;
    }

    .category-card:hover .cat-icon-box {
        background: var(--primary);
        color: #fff;
    }

    .product-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        overflow: hidden;
        transition: 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 18px 35px rgba(0, 0, 0, 0.08);
        border-color: var(--primary);
    }

    .prod-img-box {
        height: 210px;
        background: #f9fafb;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
        cursor: pointer;
    }

    .prod-img {
        height: 150px;
        transition: 0.3s ease;
    }

    .product-card:hover .prod-img {
        transform: scale(1.08);
    }

    .product-card .p-3 {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .product-card h6 {
        min-height: 40px;
    }

    .add-btn {
        width: 100%;
        border: 1px solid var(--primary);
        color: var(--primary);
        background: transparent;
        padding: 10px;
        border-radius: 10px;
        font-weight: 600;
        transition: 0.3s ease;
    }

    .add-btn:hover {
        background: var(--primary);
        color: #fff;
    }
</style>
@endsection

@section('content')

{{-- HERO --}}
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <span class="badge bg-success bg-opacity-10 text-success border border-success mb-3 px-3 py-2 rounded-pill">
                    <i class="fas fa-check-circle me-1"></i>
                    {{ $banner->badge_text }}
                </span>
                <h1 class="display-4 fw-bold mb-3">
                    {{ $banner->heading }}
                    <br>
                    <span style="color:var(--primary)">
                        {{ $banner->highlight_text }}
                    </span>
                </h1>
                <p class="lead text-secondary mb-4">
                    {{ $banner->description }}
                </p>
                <a href="{{ route('home.index') }}" class="hero-btn shadow-lg">
                    <i class="fas fa-shopping-cart me-2"></i>
                    {{ $banner->button_text }}
                </a>
            </div>
            <div class="col-lg-6 text-center">
                <img src="{{ asset('uploads/banners/'.$banner->image) }}" class="hero-img img-fluid" alt="Banner">
            </div>
        </div>
    </div>
</section>

{{-- CATEGORIES --}}
<section class="py-5">
    <div class="container">
        <h3 class="fw-bold mb-4">Shop by Category</h3>
        <div class="row g-4">
            @foreach($categories as $category)
            <div class="col-6 col-md-3">
                <a href="{{ route('category.show',$category->slug) }}" class="text-decoration-none">
                    <div class="category-card">
                        <div class="cat-icon-box">
                            <i class="fas {{ $category->icon }}"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-0">
                            {{ $category->name }}
                        </h6>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- TRENDING PRODUCTS --}}
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="fw-bold text-center mb-5">Trending Essentials</h2>
        <div class="row g-4">
            @foreach($products as $product)
            <div class="col-md-3 col-6">
                <div class="product-card">
                    <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none">
                        <div class="prod-img-box">
                            @if($product->discount)
                            <span class="badge bg-danger position-absolute top-0 start-0 m-3">
                                {{ $product->discount }}% OFF
                            </span>
                            @endif
                            <img src="{{ asset('uploads/products/'.$product->image) }}" class="prod-img" alt="{{ $product->name }}">
                        </div>
                    </a>

                    <div class="p-3">
                        <div>
                            <small class="text-muted">
                                <i class="fas fa-tag me-1"></i>
                                {{ $product->category }}
                            </small>
                            <h6 class="fw-bold mt-1 mb-2">
                                {{ $product->name }}
                            </h6>
                        </div>

                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="h5 fw-bold mb-0">
                                    ₹{{ $product->price }}
                                </span>
                                @if($product->old_price)
                                <small class="text-decoration-line-through text-muted">
                                    ₹{{ $product->old_price }}
                                </small>
                                @endif
                            </div>

                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="add-btn">
                                    <i class="fas fa-cart-plus me-1"></i>
                                    Add
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
