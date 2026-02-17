@extends('master_nav')

@section('title', $category->name . ' - Medi-Go')

@section('styles')
<style>

/* Category Hero */
.category-hero {
    background: radial-gradient(circle at top right, #d1fae5, #ffffff);
    padding: 60px 0;
}

/* Product Card */
.product-card {
    background: white;
    border-radius: 18px;
    border: 1px solid #eef2f7;
    overflow: hidden;
    transition: 0.3s;
    height: 100%;
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    border-color: var(--primary);
}

/* Image Box */
.prod-img-box {
    height: 200px;
    background: #f8fafc;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.prod-img {
    height: 140px;
    transition: 0.4s;
}

.product-card:hover .prod-img {
    transform: scale(1.1);
}

/* Discount Badge */
.discount-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    font-size: 12px;
}

/* Add Button */
.add-btn {
    width: 100%;
    border-radius: 10px;
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

/* Empty State */
.empty-box {
    padding: 60px;
    background: white;
    border-radius: 20px;
}

</style>
@endsection


@section('content')

{{-- CATEGORY HERO --}}
<section class="category-hero">
    <div class="container text-center">

        <h1 class="fw-bold mb-2">
            {{ $category->name }}
        </h1>

        <p class="text-muted">
            Explore the best {{ $category->name }} products curated for your health.
        </p>

    </div>
</section>



{{-- PRODUCT LIST --}}
<section class="py-5 bg-light">
<div class="container">

<div class="row g-4">

@forelse($products as $product)

<div class="col-lg-3 col-md-4 col-6">

<div class="product-card">

    {{-- IMAGE --}}
    <div class="prod-img-box">

        @if($product->discount)
        <span class="badge bg-danger discount-badge">
            {{ $product->discount }}% OFF
        </span>
        @endif

        <img src="{{ asset('uploads/products/'.$product->image) }}"
             class="prod-img"
             alt="{{ $product->name }}">

    </div>


    {{-- BODY --}}
    <div class="p-3">

        <small class="text-muted">
            {{ $product->category }}
        </small>

        <h6 class="fw-bold mt-1 mb-2">
            {{ $product->name }}
        </h6>


        <div class="d-flex justify-content-between align-items-center mb-3">

            <span class="fw-bold text-dark fs-5">
                ₹{{ $product->price }}
            </span>

            @if($product->old_price)
            <small class="text-muted text-decoration-line-through">
                ₹{{ $product->old_price }}
            </small>
            @endif

        </div>


        <button class="add-btn">
            <i class="fas fa-cart-plus me-1"></i>
            Add to Cart
        </button>

    </div>

</div>

</div>

@empty


{{-- EMPTY STATE --}}
<div class="col-12">

<div class="empty-box text-center shadow-sm">

    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>

    <h4 class="fw-bold">
        No Products Found
    </h4>

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

@endsection
