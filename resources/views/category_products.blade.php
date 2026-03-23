@extends('master_nav')

@section('title', $category->name . ' - Medi-Go')

@section('styles')
<style>
    :root {
        --primary: #059669;
        --primary-dark: #047857;
    }

    .category-hero {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        padding: 60px 0;
        margin-bottom: 50px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .category-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
    }

    .category-hero h1 {
        font-size: 2.8rem;
        font-weight: 900;
        margin: 0 0 15px 0;
        position: relative;
        z-index: 1;
    }

    .category-hero p {
        font-size: 1.1rem;
        opacity: 0.95;
        position: relative;
        z-index: 1;
    }

    .filters-section {
        background: white;
        border-radius: 18px;
        padding: 28px;
        margin-bottom: 40px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
    }

    .filter-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f1f5f9;
    }

    .filter-header h5 {
        font-weight: 800;
        color: #111827;
        margin: 0;
        font-size: 1.1rem;
    }

    .clear-filters {
        background: none;
        border: none;
        color: var(--primary);
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
        padding: 6px 12px;
        border-radius: 8px;
    }

    .clear-filters:hover {
        background: #ecfdf5;
    }

    .filter-group {
        margin-bottom: 24px;
    }

    .filter-group:last-child {
        margin-bottom: 0;
    }

    .filter-label {
        font-weight: 700;
        color: #111827;
        margin-bottom: 12px;
        display: block;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .price-range-container {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .price-input {
        flex: 1;
        padding: 10px 14px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-weight: 600;
        color: #111827;
        transition: all 0.3s ease;
    }

    .price-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.1);
    }

    .price-separator {
        color: #cbd5e1;
        font-weight: 700;
    }

    .sort-options {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .sort-btn {
        padding: 10px 16px;
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

    .products-section {
        background: #f8fafc;
        padding: 40px 0;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 28px;
    }

    .product-card {
        background: white;
        border-radius: 18px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
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
        position: relative;
        overflow: hidden;
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

    .wishlist-btn {
        position: absolute;
        top: 14px;
        right: 14px;
        background: white;
        border-radius: 50%;
        width: 42px;
        height: 42px;
        border: 2px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        cursor: pointer;
        z-index: 2;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .wishlist-btn:hover {
        background: #fee2e2;
        border-color: #ef4444;
        transform: scale(1.1);
    }

    .wishlist-btn i {
        color: #ef4444;
        font-size: 1.1rem;
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

    .add-btn {
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

    .add-btn:hover {
        background: var(--primary);
        color: white !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(5, 150, 105, 0.3);
    }

    .add-btn i {
        transition: all 0.3s ease;
    }

    .add-btn:hover i {
        color: white !important;
    }

    .empty-box {
        padding: 100px 40px;
        background: white;
        border-radius: 20px;
        text-align: center;
        border: 2px dashed #cbd5e1;
    }

    .empty-box i {
        font-size: 4rem;
        background: linear-gradient(135deg, var(--primary), #10b981);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 25px;
        display: block;
    }

    .empty-box h4 {
        color: #111827;
        font-weight: 900;
        font-size: 1.8rem;
        margin-bottom: 12px;
    }

    .empty-box p {
        color: #94a3b8;
        margin-bottom: 30px;
        font-size: 1.05rem;
    }

    .empty-box .btn {
        padding: 12px 32px;
        font-weight: 700;
        transition: all 0.3s ease;
    }

    .empty-box .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(5, 150, 105, 0.3);
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

    @media (max-width: 768px) {
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 16px;
        }

        .category-hero h1 {
            font-size: 2rem;
        }

        .filter-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .price-range-container {
            flex-direction: column;
        }

        .sort-options {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')

{{-- HERO --}}
<section class="category-hero">
    <div class="container">
        <h1><i class="fas fa-tag me-3"></i>{{ $category->name }}</h1>
        <p>Explore the best {{ $category->name }} products curated for your health.</p>
    </div>
</section>

<div class="container">
    {{-- FILTERS --}}
    <div class="filters-section">
        <div class="filter-header">
            <h5><i class="fas fa-sliders-h me-2"></i>Filters</h5>
            <button class="clear-filters" onclick="clearAllFilters()">
                <i class="fas fa-times me-1"></i>Clear All
            </button>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="filter-group">
                    <label class="filter-label">Price Range</label>
                    <div class="price-range-container">
                        <input 
                            type="number" 
                            id="minPrice" 
                            class="price-input" 
                            placeholder="Min"
                            min="0"
                        >
                        <span class="price-separator">-</span>
                        <input 
                            type="number" 
                            id="maxPrice" 
                            class="price-input" 
                            placeholder="Max"
                            min="0"
                        >
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="filter-group">
                    <label class="filter-label">Sort By</label>
                    <div class="sort-options">
                        <button class="sort-btn active" onclick="sortProducts('relevant')">
                            <i class="fas fa-star me-1"></i>Relevant
                        </button>
                        <button class="sort-btn" onclick="sortProducts('price-low')">
                            <i class="fas fa-arrow-up me-1"></i>Price: Low
                        </button>
                        <button class="sort-btn" onclick="sortProducts('price-high')">
                            <i class="fas fa-arrow-down me-1"></i>Price: High
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- PRODUCTS --}}
<section class="products-section pb-5">
    <div class="container">
        <div class="products-grid" id="productsGrid">
            @forelse($products as $product)
            <div class="product-card fade-in product-item" data-price="{{ $product->price }}">
                <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none">
                    <div class="prod-img-box">
                        @if($product->discount)
                        <span class="discount-badge">
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
                <form action="{{ route('wishlist.add') }}" method="POST" class="wishlist-form" style="position: absolute; top: 14px; right: 14px; z-index: 2;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="wishlist-btn" title="Add to Wishlist">
                        <i class="fas fa-heart"></i>
                    </button>
                </form>
                @else
                <a href="{{ route('login') }}" class="wishlist-btn" title="Login to add to Wishlist" style="text-decoration: none;">
                    <i class="fas fa-heart"></i>
                </a>
                @endauth

                {{-- BODY --}}
                <div class="product-body">
                    <div>
                        <small class="product-category">
                            {{ $category->name }}
                        </small>
                        <h6 class="product-name">
                            {{ $product->name }}
                        </h6>
                    </div>

                    <div>
                        <div class="product-price-box">
                            <span class="product-price">
                                ₹{{ number_format($product->price, 2) }}
                            </span>

                            @if($product->old_price)
                            <small class="product-old-price">
                                ₹{{ number_format($product->old_price, 2) }}
                            </small>
                            @endif
                        </div>

                        {{-- ADD TO CART --}}
                        @auth
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="add-btn">
                                <i class="fas fa-cart-plus"></i>
                                <span>Add to Cart</span>
                            </button>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="add-btn">
                            <i class="fas fa-cart-plus"></i>
                            <span>Login to Add</span>
                        </a>
                        @endauth
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1;">
                <div class="empty-box">
                    <i class="fas fa-box-open"></i>
                    <h4>No Products Found</h4>
                    <p>This category currently has no products available.</p>
                    <a href="{{ url('/') }}" class="btn btn-success rounded-pill px-4">
                        <i class="fas fa-home me-2"></i>Back to Home
                    </a>
                </div>
            </div>
            @endforelse
        </div>

        <div id="noResults" class="empty-box" style="display: none; margin-top: 40px;">
            <i class="fas fa-inbox"></i>
            <h4>No Products Match Your Filters</h4>
            <p>Try adjusting your price range or sort options.</p>
            <button class="btn btn-success rounded-pill px-4" onclick="clearAllFilters()">
                <i class="fas fa-redo me-2"></i>Reset Filters
            </button>
        </div>
    </div>
</section>

<script>
    const minPriceInput = document.getElementById('minPrice');
    const maxPriceInput = document.getElementById('maxPrice');
    const productsGrid = document.getElementById('productsGrid');
    const productItems = document.querySelectorAll('.product-item');
    const noResults = document.getElementById('noResults');

    function filterProducts() {
        const minPrice = parseFloat(minPriceInput.value) || 0;
        const maxPrice = parseFloat(maxPriceInput.value) || Infinity;
        let visibleCount = 0;

        productItems.forEach(item => {
            const price = parseFloat(item.dataset.price);
            
            if (price >= minPrice && price <= maxPrice) {
                item.style.display = '';
                item.classList.add('fade-in');
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        if (visibleCount === 0) {
            productsGrid.style.display = 'none';
            noResults.style.display = 'block';
        } else {
            productsGrid.style.display = 'grid';
            noResults.style.display = 'none';
        }
    }

    function sortProducts(type) {
        const cards = Array.from(productsGrid.querySelectorAll('.product-item:not([style*="display: none"])'));
        
        document.querySelectorAll('.sort-btn').forEach(btn => btn.classList.remove('active'));
        event.target.closest('.sort-btn').classList.add('active');

        if (type === 'price-low') {
            cards.sort((a, b) => parseFloat(a.dataset.price) - parseFloat(b.dataset.price));
        } else if (type === 'price-high') {
            cards.sort((a, b) => parseFloat(b.dataset.price) - parseFloat(a.dataset.price));
        }

        cards.forEach(card => {
            card.classList.remove('fade-in');
            productsGrid.appendChild(card);
            setTimeout(() => card.classList.add('fade-in'), 10);
        });
    }

    function clearAllFilters() {
        minPriceInput.value = '';
        maxPriceInput.value = '';
        document.querySelectorAll('.sort-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelector('.sort-btn').classList.add('active');
        
        productItems.forEach(item => {
            item.style.display = '';
            item.classList.add('fade-in');
        });

        productsGrid.style.display = 'grid';
        noResults.style.display = 'none';
    }

    minPriceInput.addEventListener('input', filterProducts);
    maxPriceInput.addEventListener('input', filterProducts);
</script>

@endsection
