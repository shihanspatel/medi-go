@extends('master_nav')

@section('title', 'My Wishlist - Medi-Go')

@section('styles')
<style>
    :root {
        --primary: #059669;
        --primary-dark: #047857;
    }

    /* WISHLIST CARD */

    .premium-wish-card {
        background: white;
        border-radius: 18px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
        transition: .3s;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .premium-wish-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 18px 35px rgba(0, 0, 0, 0.08);
        border-color: var(--primary);
    }

    /* IMAGE */

    .img-container {
        height: 200px;
        background: #f9fafb;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .wish-img {
        max-height: 150px;
        transition: .3s;
    }

    .premium-wish-card:hover .wish-img {
        transform: scale(1.08);
    }

    /* ACTION BUTTONS */

    .card-actions {
        position: absolute;
        bottom: 10px;
        left: 10px;
        right: 10px;
        display: flex;
        gap: 8px;
        opacity: 0;
        transform: translateY(10px);
        transition: .3s;
    }

    .premium-wish-card:hover .card-actions {
        opacity: 1;
        transform: translateY(0);
    }

    /* CONTENT */

    .wish-content {
        padding: 16px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    /* CATEGORY */

    .wish-cat {
        font-size: 0.8rem;
        color: #64748b;
    }

    /* TITLE */

    .wish-title {
        font-weight: 700;
        margin-top: 5px;
        margin-bottom: 8px;
        min-height: 40px;
    }

    /* PRICE */

    .price-wrap {
        font-weight: 800;
        font-size: 1.1rem;
        color: var(--primary);
    }
</style>
@endsection


@section('content')

<div class="container py-5">

    <h2 class="fw-bold mb-4">
        My Wishlist
        ({{ $wishlistItems->count() }} Items)
    </h2>

    <div class="row g-4">

        @forelse($wishlistItems as $item)

        <div class="col-md-4 col-lg-3">

            <div class="premium-wish-card">

                <div class="img-container">

                    <img src="{{ asset('storage/'.$item->product->image) }}"
                        class="wish-img"
                        alt="{{ $item->product->name }}">

                    <div class="card-actions">

                        {{-- ADD TO CART --}}
                        <form action="{{ route('cart.add') }}" method="POST" class="flex-grow-1">
                            @csrf

                            <input type="hidden"
                                name="product_id"
                                value="{{ $item->product->id }}">

                            <button class="btn btn-success w-100 rounded-pill btn-sm fw-bold">
                                Add to Cart
                            </button>

                        </form>

                        {{-- REMOVE --}}
                        <form action="{{ route('wishlist.remove',$item->id) }}"
                            method="POST">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-light rounded-circle btn-sm border">
                                <i class="fas fa-trash-alt text-danger"></i>
                            </button>

                        </form>

                    </div>
                </div>


                <div class="wish-content">

                    <span class="wish-cat">
                        {{ $item->product->category->name ?? 'Medicine' }}
                    </span>

                    <h6 class="wish-title">
                        {{ $item->product->name }}
                    </h6>

                    <div class="price-wrap">
                        ₹{{ number_format($item->product->price,2) }}
                    </div>

                </div>

            </div>

        </div>

        @empty

        <div class="col-12 text-center py-5">

            <i class="fas fa-heart fa-3x text-muted mb-3"></i>

            <h4>Your Wishlist is Empty</h4>

            <a href="{{ url('/medicines') }}"
                class="btn btn-primary mt-3 rounded-pill">
                Browse Medicines
            </a>

        </div>

        @endforelse

    </div>

</div>

@endsection