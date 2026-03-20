@extends('master_nav')

@section('title', 'My Wishlist - Medi-Go')

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

    /* WISHLIST CARD */

    .premium-wish-card {
        background: white;
        border-radius: 20px;
        border: 2px solid #e5e7eb;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .premium-wish-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 40px rgba(5, 150, 105, 0.15);
        border-color: var(--primary);
    }

    /* IMAGE CONTAINER */

    .img-container {
        height: 220px;
        background: linear-gradient(135deg, #f0fdf4 0%, #f8fafc 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .wish-img {
        max-height: 160px;
        max-width: 90%;
        transition: transform 0.3s ease;
        object-fit: contain;
    }

    .premium-wish-card:hover .wish-img {
        transform: scale(1.1);
    }

    /* BADGE */

    .stock-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: var(--success);
        color: white;
        padding: 6px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
    }

    /* ACTION BUTTONS */

    .card-actions {
        position: absolute;
        bottom: 12px;
        left: 12px;
        right: 12px;
        display: flex;
        gap: 10px;
        opacity: 0;
        transform: translateY(15px);
        transition: all 0.3s ease;
    }

    .premium-wish-card:hover .card-actions {
        opacity: 1;
        transform: translateY(0);
    }

    .action-btn {
        flex: 1;
        padding: 10px 12px;
        border-radius: 12px;
        border: none;
        font-weight: 700;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-add-cart {
        background: var(--primary);
        color: white;
    }

    .btn-add-cart:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }

    .btn-remove {
        background: #fee2e2;
        color: #dc2626;
    }

    .btn-remove:hover {
        background: #fecaca;
    }

    /* CONTENT */

    .wish-content {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    /* CATEGORY */

    .wish-cat {
        font-size: 0.8rem;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    /* TITLE */

    .wish-title {
        font-weight: 700;
        margin-top: 8px;
        margin-bottom: 12px;
        min-height: 45px;
        color: #1f2937;
        line-height: 1.4;
    }

    /* PRICE */

    .price-wrap {
        font-weight: 800;
        font-size: 1.3rem;
        color: var(--primary);
        margin-bottom: 8px;
    }

    .rating-stars {
        color: #fbbf24;
        font-size: 0.9rem;
    }

    /* EMPTY STATE */

    .empty-state {
        text-align: center;
        padding: 60px 20px;
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

    .browse-btn {
        background: linear-gradient(135deg, var(--primary) 0%, var(--success) 100%);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 700;
        transition: all 0.3s ease;
    }

    .browse-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(5, 150, 105, 0.3);
    }

    /* RESPONSIVE */

    @media (max-width: 768px) {
        .page-header h2 {
            font-size: 1.5rem;
        }

        .premium-wish-card:hover {
            transform: translateY(-8px);
        }

        .card-actions {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection


@section('content')

<div class="page-header">
    <div class="container">
        <h2><i class="fas fa-heart me-2"></i>My Wishlist</h2>
        <p>{{ $wishlistItems->count() }} item{{ $wishlistItems->count() !== 1 ? 's' : '' }} saved</p>
    </div>
</div>

<div class="container pb-5">
    <div class="row g-4">

        @forelse($wishlistItems as $item)

        <div class="col-md-6 col-lg-4 col-xl-3">

            <div class="premium-wish-card">

                <div class="img-container">

                    <img src="{{ asset('images/product_Images/'.$item->product->image) }}"
                        class="wish-img"
                        alt="{{ $item->product->name }}">

                    <span class="stock-badge">
                        <i class="fas fa-check-circle me-1"></i>In Stock
                    </span>

                    <div class="card-actions">

                        {{-- ADD TO CART --}}
                        <form action="{{ route('cart.add') }}" method="POST" style="flex: 1;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                            <button type="submit" class="action-btn btn-add-cart w-100">
                                <i class="fas fa-shopping-cart me-1"></i>Add to Cart
                            </button>
                        </form>

                        {{-- REMOVE --}}
                        <form action="{{ route('wishlist.remove',$item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn btn-remove" style="flex: 0.4;">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>

                    </div>
                </div>

                <div class="wish-content">

                    <div>
                        <span class="wish-cat">
                            {{ $item->product->category ?? 'Medicine' }}
                        </span>

                        <h6 class="wish-title">
                            {{ $item->product->name }}
                        </h6>

                        <div class="rating-stars">
                            @for($i = 0; $i < 5; $i++)
                                @if($i < floor($item->product->averageRating()))
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="fas fa-star" style="color: #e5e7eb;"></i>
                                @endif
                            @endfor
                            <span class="text-muted small">({{ $item->product->ratingCount() }})</span>
                        </div>
                    </div>

                    <div class="price-wrap">
                        ₹{{ number_format($item->product->price, 2) }}
                    </div>

                </div>

            </div>

        </div>

        @empty

        <div class="col-12">
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="far fa-heart"></i>
                </div>
                <h4>Your Wishlist is Empty</h4>
                <p>Start adding your favorite medicines to your wishlist!</p>
                <a href="{{ route('home.index') }}" class="browse-btn">
                    <i class="fas fa-shopping-bag me-2"></i>Browse Medicines
                </a>
            </div>
        </div>

        @endforelse

    </div>
</div>

@endsection
