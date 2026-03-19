@extends('master_nav')

@section('title', $product->name . ' - Medi-Go')

@section('styles')
<style>
    body { background-color: #f8fafc; }
    .main-img-box {
        background: white;
        border-radius: 15px;
        border: 1px solid #e5e7eb;
        height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }
    .main-img { max-height: 300px; max-width: 90%; object-fit: contain; }
    .product-title { font-weight: 800; color: #111827; }
    .product-price { font-size: 2rem; font-weight: 800; color: #059669; }
    .old-price { font-size: 1.2rem; color: #94a3b8; text-decoration: line-through; }
    .qty-wrapper {
        display: inline-flex;
        align-items: center;
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 50px;
        padding: 5px;
    }
    .qty-btn {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: #f1f5f9;
        border: none;
        cursor: pointer;
    }
    .qty-btn:hover { background: #059669; color: white; }
    .qty-val { width: 40px; text-align: center; border: none; font-weight: 700; background: transparent; }
    .custom-tabs .nav-link {
        color: #64748b;
        font-weight: 700;
        border-bottom: 3px solid transparent;
        padding: 15px 25px;
    }
    .custom-tabs .nav-link.active {
        color: #059669;
        border-bottom-color: #059669;
    }
    .rating-box {
        background: white;
        border-radius: 15px;
        padding: 30px;
        border: 1px solid #e5e7eb;
    }
    .big-rating { font-size: 3.5rem; font-weight: 800; color: #111827; }
    .star-yellow { color: #fbbf24; }
    .review-card {
        border-bottom: 1px solid #e5e7eb;
        padding: 20px 0;
    }
    .review-card:last-child { border-bottom: none; }
    .reviewer-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: #e2e8f0;
        object-fit: cover;
    }
</style>
@endsection

@section('content')

<div class="container py-5">
    <div class="row g-5 mb-5">
        {{-- Product Image --}}
        <div class="col-lg-6">
            <div class="main-img-box mb-3">
                <img src="{{ asset('images/product_Images/'.$product->image) }}" class="main-img" alt="{{ $product->name }}">
            </div>
        </div>

        {{-- Product Info --}}
        <div class="col-lg-6">
            <span class="badge bg-success bg-opacity-10 text-success fw-bold mb-2">In Stock</span>
            <h1 class="product-title">{{ $product->name }}</h1>
            
            <div class="d-flex align-items-center mb-3">
                <div class="me-2">
                    @for($i = 0; $i < 5; $i++)
                        @if($i < floor($avgRating))
                            <i class="fas fa-star star-yellow"></i>
                        @elseif($i < $avgRating)
                            <i class="fas fa-star-half-alt star-yellow"></i>
                        @else
                            <i class="fas fa-star" style="color: #e2e8f0;"></i>
                        @endif
                    @endfor
                </div>
                <span class="text-muted small fw-bold">({{ $ratingCount }} Reviews)</span>
            </div>

            <div class="product-price mb-4">
                ₹{{ number_format($product->price, 2) }}
                @if($product->old_price)
                    <span class="old-price">₹{{ number_format($product->old_price, 2) }}</span>
                @endif
            </div>

            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="qty-wrapper">
                    <button class="qty-btn" onclick="this.nextElementSibling.stepDown()"><i class="fas fa-minus"></i></button>
                    <input type="number" class="qty-val" value="1" min="1" readonly>
                    <button class="qty-btn" onclick="this.previousElementSibling.stepUp()"><i class="fas fa-plus"></i></button>
                </div>
                <form action="{{ route('cart.add') }}" method="POST" class="flex-grow-1">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button class="btn btn-success rounded-pill px-5 py-2 fw-bold w-100">
                        <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                    </button>
                </form>
                <button class="btn btn-outline-dark rounded-circle p-2" style="width: 45px; height: 45px;">
                    <i class="far fa-heart"></i>
                </button>
            </div>

            <div class="border-top pt-4">
                <div class="d-flex mb-2">
                    <span class="text-muted fw-bold" style="width: 100px;">Category:</span>
                    <span class="text-success fw-bold">{{ $product->category }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabs --}}
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-tabs custom-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item"><button class="nav-link active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc">Description</button></li>
                <li class="nav-item"><button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews">Reviews ({{ $ratingCount }})</button></li>
            </ul>

            <div class="tab-content" id="myTabContent">
                {{-- Description Tab --}}
                <div class="tab-pane fade show active" id="desc">
                    <div class="bg-white p-4 rounded-4 border border-light">
                        <h5 class="fw-bold mb-3">Product Details</h5>
                        <p class="text-secondary">{{ $product->description ?? 'No description available' }}</p>
                    </div>
                </div>

                {{-- Reviews Tab --}}
                <div class="tab-pane fade" id="reviews">
                    <div class="row g-4">
                        {{-- Rating Summary --}}
                        <div class="col-lg-4">
                            <div class="rating-box">
                                <div class="big-rating">{{ number_format($avgRating, 1) }}</div>
                                <div class="mb-3">
                                    @for($i = 0; $i < 5; $i++)
                                        @if($i < floor($avgRating))
                                            <i class="fas fa-star star-yellow"></i>
                                        @elseif($i < $avgRating)
                                            <i class="fas fa-star-half-alt star-yellow"></i>
                                        @else
                                            <i class="fas fa-star" style="color: #e2e8f0;"></i>
                                        @endif
                                    @endfor
                                </div>
                                <p class="text-muted small">Based on {{ $ratingCount }} reviews</p>
                            </div>
                        </div>

                        {{-- Reviews List & Form --}}
                        <div class="col-lg-8">
                            <div class="bg-white p-4 rounded-4 border border-light">
                                {{-- Add Review Form --}}
                                @auth
                                <div class="mb-4 pb-4 border-bottom">
                                    <h6 class="fw-bold mb-3">Leave a Review</h6>
                                    <form action="{{ route('rating.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Rating</label>
                                            <div class="d-flex gap-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}" class="d-none">
                                                    <label for="star{{ $i }}" class="cursor-pointer" style="font-size: 1.5rem;">
                                                        <i class="fas fa-star" style="color: #e2e8f0;"></i>
                                                    </label>
                                                @endfor
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <textarea name="review" class="form-control" rows="3" placeholder="Share your experience..."></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-success rounded-pill">Submit Review</button>
                                    </form>
                                </div>
                                @else
                                <div class="alert alert-info mb-4">
                                    <a href="{{ route('login') }}" class="alert-link">Login</a> to leave a review
                                </div>
                                @endauth

                                {{-- Reviews List --}}
                                <h6 class="fw-bold mb-3">Customer Reviews</h6>
                                @forelse($ratings as $rating)
                                    <div class="review-card">
                                        <div class="d-flex gap-3 mb-2">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($rating->user->name) }}&background=059669&color=fff" class="reviewer-avatar">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0 fw-bold">{{ $rating->user->name }}</h6>
                                                <small class="text-muted">{{ $rating->created_at->diffForHumans() }}</small>
                                            </div>
                                            <div class="text-warning">
                                                @for($i = 0; $i < $rating->rating; $i++)
                                                    <i class="fas fa-star"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <p class="text-secondary small">{{ $rating->review }}</p>
                                    </div>
                                @empty
                                    <p class="text-muted text-center py-4">No reviews yet. Be the first to review!</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Star rating interaction
    document.querySelectorAll('input[name="rating"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('label[for^="star"]').forEach((label, index) => {
                if(index < this.value) {
                    label.innerHTML = '<i class="fas fa-star star-yellow"></i>';
                } else {
                    label.innerHTML = '<i class="fas fa-star" style="color: #e2e8f0;"></i>';
                }
            });
        });
    });
</script>

@endsection
