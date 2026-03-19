<!-- @extends('master_nav')

@section('title', $category->name . ' - Medi-Go')

@section('styles')
<style>
    .category-hero {
        background: radial-gradient(circle at top right, #d1fae5, #ffffff);
        padding: 60px 0;
    }

    .product-card {
        background: white;
        border-radius: 20px;
        border: 1px solid #eef2f7;
        overflow: hidden;
        transition: 0.3s ease;
        height: 100%;
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        border-color: var(--primary);
    }

    .prod-img-box {
        height: 200px;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        cursor: pointer;
    }

    .prod-img {
        height: 140px;
        transition: 0.4s;
    }

    .product-card:hover .prod-img {
        transform: scale(1.1);
    }

    .discount-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        font-size: 12px;
    }

    .wishlist-btn {
        position: absolute;
        top: 12px;
        right: 12px;
        background: white;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        border: 1px solid #eee;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.3s;
    }

    .wishlist-btn:hover {
        background: #fee2e2;
    }

    .wishlist-btn i {
        color: #ef4444;
    }

    .add-btn {
        width: 100%;
        border-radius: 12px;
        border: 1px solid var(--primary);
        background: transparent;
        color: var(--primary);
        font-weight: 600;
        padding: 8px;
        transition: 0.3s;
    }

    .add-btn:hover {
        background: var(--primary);
        color: white;
    }

    .empty-box {
        padding: 60px;
        background: white;
        border-radius: 20px;
    }
</style>
@endsection

@section('content')

{{-- HERO --}}
<section class="category-hero">
    <div class="container text-center">
        <h1 class="fw-bold mb-2">{{ $category->name }}</h1>
        <p class="text-muted">
            Explore the best {{ $category->name }} products curated for your health.
        </p>
    </div>
</section>

{{-- PRODUCTS --}}
<section class="py-5 bg-light">
<div class="container">
<div class="row g-4">

@forelse($products as $product)

<div class="col-lg-3 col-md-4 col-6">

<div class="product-card">

    {{-- IMAGE --}}
    <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none">
        <div class="prod-img-box">

            @if($product->discount)
            <span class="badge bg-danger discount-badge">
                {{ $product->discount }}% OFF
            </span>
            @endif

            <img src="{{ asset('images/product_Images/'.$product->image) }}"
                 class="prod-img"
                 alt="{{ $product->name }}">
        </div>
    </a>

    {{-- WISHLIST --}}
    @auth
    <form action="{{ route('wishlist.add') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <button type="submit" class="wishlist-btn">
            <i class="fas fa-heart"></i>
        </button>
    </form>
    @else
    <a href="{{ route('login') }}" class="wishlist-btn">
        <i class="fas fa-heart"></i>
    </a>
    @endauth

    {{-- BODY --}}
    <div class="p-3">

        <small class="text-muted">
            {{ $category->name }}
        </small>

        <h6 class="fw-bold mt-1 mb-2">
            {{ $product->name }}
        </h6>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="fw-bold text-dark fs-5">
                ₹{{ number_format($product->price,2) }}
            </span>

            @if($product->old_price)
            <small class="text-muted text-decoration-line-through">
                ₹{{ number_format($product->old_price,2) }}
            </small>
            @endif
        </div>

        {{-- ADD TO CART --}}
        @auth
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit" class="add-btn">
                <i class="fas fa-cart-plus me-1"></i>
                Add to Cart
            </button>
        </form>
        @else
        <a href="{{ route('login') }}"
           class="add-btn d-block text-center">
            <i class="fas fa-cart-plus me-1"></i>
            Login to Add
        </a>
        @endauth

    </div>

</div>

</div>

@empty

<div class="col-12">
<div class="empty-box text-center shadow-sm">
    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
    <h4 class="fw-bold">No Products Found</h4>
    <p class="text-muted">
        This category currently has no products available.
    </p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-2">
        Back to Home
    </a>
</div>
</div>

@endforelse

</div>
</div>
</section>

@endsection -->
