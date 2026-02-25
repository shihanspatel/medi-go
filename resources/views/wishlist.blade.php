@extends('master_nav')

@section('title', 'My Wishlist - Medi-Go')

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

                        {{-- Add To Cart --}}
                        <form action="{{ route('cart.add') }}" method="POST" class="flex-grow-1">
                            @csrf
                            <input type="hidden" name="product_id" 
                                   value="{{ $item->product->id }}">
                            <button class="btn btn-success w-100 rounded-pill btn-sm fw-bold">
                                Add to Cart
                            </button>
                        </form>

                        {{-- Remove --}}
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
                        ₹{{ number_format($item->product->price, 2) }}
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