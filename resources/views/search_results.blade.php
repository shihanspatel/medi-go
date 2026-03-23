@extends('master_nav')

@section('title','Search Results - Medi-Go')

@section('styles')
<style>
    :root {
        --primary: #059669;
        --primary-dark: #047857;
    }

    body {
        background: #f8fafc;
    }

    .search-header {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        padding: 60px 0;
        margin-bottom: 50px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .search-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
    }

    .search-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    .search-header-content {
        position: relative;
        z-index: 1;
    }

    .search-header h1 {
        font-size: 3rem;
        font-weight: 900;
        margin: 0 0 15px 0;
        letter-spacing: -1px;
    }

    .search-header p {
        font-size: 1.1rem;
        opacity: 0.95;
        margin: 0;
    }

    .search-term {
        font-weight: 800;
        background: rgba(255, 255, 255, 0.2);
        padding: 2px 8px;
        border-radius: 6px;
        display: inline-block;
    }

    .results-info {
        background: white;
        border-radius: 16px;
        padding: 20px 28px;
        margin-bottom: 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
    }

    .results-count {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .count-number {
        font-size: 2rem;
        font-weight: 900;
        color: var(--primary);
    }

    .count-text {
        color: #64748b;
        font-weight: 600;
    }

    .sort-options {
        display: flex;
        gap: 12px;
    }

    .sort-btn {
        padding: 10px 18px;
        border: 2px solid #e5e7eb;
        background: white;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        color: #64748b;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .sort-btn:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: #ecfdf5;
    }

    .sort-btn.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 28px;
        margin-bottom: 50px;
    }

    .product-card {
        background: white;
        border-radius: 18px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
        height: 100%;
        position: relative;
    }

    .product-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), #10b981);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
        z-index: 1;
    }

    .product-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 50px rgba(5, 150, 105, 0.15);
        border-color: var(--primary);
    }

    .product-card:hover::before {
        transform: scaleX(1);
    }

    .prod-img-box {
        height: 240px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
    }

    .prod-img {
        height: 160px;
        object-fit: contain;
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .product-card:hover .prod-img {
        transform: scale(1.15);
    }

    .discount-badge {
        position: absolute;
        top: 14px;
        left: 14px;
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        padding: 8px 14px;
        border-radius: 20px;
        font-weight: 800;
        font-size: 0.75rem;
        z-index: 2;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .product-body {
        padding: 22px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .product-category {
        color: #94a3b8;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .product-name {
        font-weight: 800;
        color: #111827;
        margin-bottom: 14px;
        font-size: 1.05rem;
        line-height: 1.4;
        min-height: 48px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-price-box {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        padding-bottom: 14px;
        border-bottom: 1px solid #f1f5f9;
    }

    .product-price {
        font-weight: 900;
        color: var(--primary);
        font-size: 1.35rem;
    }

    .product-old-price {
        color: #cbd5e1;
        text-decoration: line-through;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .view-btn {
        width: 100%;
        padding: 12px;
        border: 2px solid var(--primary);
        background: transparent;
        color: var(--primary);
        border-radius: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 0.95rem;
    }

    .view-btn:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(5, 150, 105, 0.3);
    }

    .empty-state {
        text-align: center;
        padding: 100px 40px;
        background: white;
        border-radius: 20px;
        border: 2px dashed #cbd5e1;
        margin-top: 40px;
    }

    .empty-state-icon {
        font-size: 5rem;
        background: linear-gradient(135deg, var(--primary), #10b981);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 25px;
        display: block;
    }

    .empty-state h3 {
        color: #111827;
        margin-bottom: 12px;
        font-weight: 900;
        font-size: 1.8rem;
    }

    .empty-state p {
        color: #94a3b8;
        margin-bottom: 30px;
        font-size: 1.05rem;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    .empty-state .btn {
        padding: 14px 36px;
        font-weight: 700;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        border-radius: 12px;
    }

    .empty-state .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(5, 150, 105, 0.3);
    }

    .fade-in {
        animation: fadeIn 0.3s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .pagination-section {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin-top: 50px;
        padding-top: 30px;
        border-top: 1px solid #e5e7eb;
    }

    .pagination-btn {
        padding: 10px 14px;
        border: 2px solid #e5e7eb;
        background: white;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        color: #64748b;
        transition: all 0.3s ease;
    }

    .pagination-btn:hover {
        border-color: var(--primary);
        color: var(--primary);
    }

    .pagination-btn.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    @media (max-width: 768px) {
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 16px;
        }

        .search-header h1 {
            font-size: 2rem;
        }

        .results-info {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }

        .sort-options {
            width: 100%;
            flex-wrap: wrap;
        }

        .prod-img-box {
            height: 180px;
        }

        .prod-img {
            height: 120px;
        }
    }
</style>
@endsection

@section('content')

<div class="search-header">
    <div class="container">
        <div class="search-header-content">
            <h1><i class="fas fa-search me-3"></i>Search Results</h1>
            <p>
                Results for <span class="search-term">"{{ $search }}"</span>
            </p>
        </div>
    </div>
</div>

<div class="container pb-5">
    @if(count($products) > 0)
        <div class="results-info">
            <div class="results-count">
                <div class="count-number">{{ count($products) }}</div>
                <div class="count-text">
                    Product{{ count($products) !== 1 ? 's' : '' }} Found
                </div>
            </div>
            <div class="sort-options">
                <button class="sort-btn active" onclick="sortProducts('relevant')">
                    <i class="fas fa-star me-1"></i>Most Relevant
                </button>
                <button class="sort-btn" onclick="sortProducts('price-low')">
                    <i class="fas fa-arrow-up me-1"></i>Price: Low to High
                </button>
                <button class="sort-btn" onclick="sortProducts('price-high')">
                    <i class="fas fa-arrow-down me-1"></i>Price: High to Low
                </button>
            </div>
        </div>

        <div class="products-grid" id="productsGrid">
            @foreach($products as $product)
            <div class="product-card fade-in" data-price="{{ $product->price }}">
                <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none">
                    <div class="prod-img-box">
                        @if($product->discount)
                        <span class="discount-badge">
                            {{ $product->discount }}% OFF
                        </span>
                        @endif
                        <img src="{{ asset('images/product_images/'.$product->image) }}" 
                             class="prod-img" 
                             alt="{{ $product->name }}">
                    </div>
                </a>

                <div class="product-body">
                    <div>
                        <div class="product-category">
                            <i class="fas fa-tag"></i>{{ $product->category ?? 'Medicine' }}
                        </div>
                        <h6 class="product-name">{{ $product->name }}</h6>
                    </div>

                    <div>
                        <div class="product-price-box">
                            <span class="product-price">₹{{ number_format($product->price, 2) }}</span>
                            @if($product->old_price)
                            <span class="product-old-price">₹{{ number_format($product->old_price, 2) }}</span>
                            @endif
                        </div>

                        <a href="{{ route('product.show', $product->id) }}" class="view-btn">
                            <i class="fas fa-eye"></i>View Details
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-search empty-state-icon"></i>
            <h3>No Products Found</h3>
            <p>We couldn't find any medicines matching "<strong>{{ $search }}</strong>". Try searching with different keywords or browse our categories.</p>
            <a href="{{ url('/') }}" class="btn btn-success rounded-pill px-5">
                <i class="fas fa-home me-2"></i>Back to Home
            </a>
        </div>
    @endif
</div>

<script>
    function sortProducts(type) {
        const grid = document.getElementById('productsGrid');
        const cards = Array.from(grid.querySelectorAll('.product-card'));
        
        // Update active button
        document.querySelectorAll('.sort-btn').forEach(btn => btn.classList.remove('active'));
        event.target.closest('.sort-btn').classList.add('active');

        if (type === 'price-low') {
            cards.sort((a, b) => parseFloat(a.dataset.price) - parseFloat(b.dataset.price));
        } else if (type === 'price-high') {
            cards.sort((a, b) => parseFloat(b.dataset.price) - parseFloat(a.dataset.price));
        }

        cards.forEach(card => {
            card.classList.remove('fade-in');
            grid.appendChild(card);
            setTimeout(() => card.classList.add('fade-in'), 10);
        });
    }
</script>

@endsection
