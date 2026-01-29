@extends('master_nav')

@section('title', 'Medicines - Browse All')

@section('styles')
<style>
    /* --- Page Layout --- */
    body { background-color: #f8fafc; }
    
    /* --- Sidebar Filters --- */
    .filter-sidebar { 
        background: white; 
        border-radius: 16px; 
        padding: 25px; 
        border: 1px solid #e2e8f0; 
        position: sticky; 
        top: 20px; 
    }
    .filter-group { margin-bottom: 25px; }
    .filter-title { 
        font-weight: 800; 
        font-size: 0.8rem; 
        letter-spacing: 0.5px;
        margin-bottom: 15px; 
        display: block; 
        color: #94a3b8; 
        text-transform: uppercase;
    }
    
    /* Custom Checkboxes */
    .custom-check { display: flex; align-items: center; margin-bottom: 10px; cursor: pointer; color: #475569; font-size: 0.95rem; transition: 0.2s; }
    .custom-check:hover { color: var(--primary); }
    .custom-check input { margin-right: 12px; accent-color: var(--primary); width: 18px; height: 18px; border-color: #cbd5e1; cursor: pointer; }

    /* --- Pretty Price Slider --- */
    .styled-range {
        -webkit-appearance: none; width: 100%; height: 6px; background: #e2e8f0; border-radius: 5px; outline: none; margin: 10px 0 15px; cursor: pointer;
    }
    /* Thumb for Chrome/Safari */
    .styled-range::-webkit-slider-thumb {
        -webkit-appearance: none; appearance: none; width: 22px; height: 22px; border-radius: 50%; 
        background: var(--primary); border: 4px solid #ffffff; box-shadow: 0 0 0 1px #cbd5e1, 0 4px 8px rgba(0,0,0,0.15); transition: transform 0.2s ease;
    }
    .styled-range::-webkit-slider-thumb:hover { transform: scale(1.15); }
    /* Thumb for Firefox */
    .styled-range::-moz-range-thumb {
        width: 22px; height: 22px; border-radius: 50%; background: var(--primary); border: 4px solid #ffffff; 
        box-shadow: 0 0 0 1px #cbd5e1, 0 4px 8px rgba(0,0,0,0.15); cursor: pointer;
    }

    /* --- Product Grid --- */
    .product-card { 
        background: white; border: 1px solid #f1f5f9; border-radius: 16px; overflow: hidden; transition: 0.3s; height: 100%; 
        position: relative; display: flex; flex-direction: column;
    }
    .product-card:hover { border-color: var(--primary); box-shadow: 0 15px 30px rgba(0,0,0,0.08); transform: translateY(-5px); }
    
    .prod-img-wrap { 
        height: 180px; display: flex; align-items: center; justify-content: center; background: #fff; padding: 20px; 
        position: relative;
    }
    .prod-img { max-height: 110px; object-fit: contain; transition: 0.3s; }
    .product-card:hover .prod-img { transform: scale(1.05); }
    
    /* Badges */
    .badge-rx { position: absolute; top: 15px; left: 15px; background: #fee2e2; color: #ef4444; font-size: 0.7rem; padding: 5px 10px; border-radius: 6px; font-weight: 700; letter-spacing: 0.5px; z-index: 2; }
    .badge-otc { position: absolute; top: 15px; left: 15px; background: #dcfce7; color: #166534; font-size: 0.7rem; padding: 5px 10px; border-radius: 6px; font-weight: 700; letter-spacing: 0.5px; z-index: 2; }
    
    /* NEW BADGE STYLE */
    .badge-new { 
        position: absolute; top: 15px; right: 15px; 
        background: #8b5cf6; /* Violet Color */
        color: #ffffff; 
        font-size: 0.7rem; padding: 5px 10px; border-radius: 6px; font-weight: 700; letter-spacing: 0.5px; z-index: 2; 
        box-shadow: 0 4px 6px rgba(139, 92, 246, 0.2);
    }

    /* Card Content */
    .card-body { padding: 20px; display: flex; flex-direction: column; flex-grow: 1; border-top: 1px solid #f8fafc; }
    .med-name { font-weight: 700; color: #1e293b; font-size: 1.05rem; margin-bottom: 4px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .med-dose { font-size: 0.85rem; color: #94a3b8; margin-bottom: 15px; display: block; }
    
    .price-tag { font-weight: 800; font-size: 1.2rem; color: #0f172a; }
    .old-price { font-size: 0.9rem; color: #94a3b8; text-decoration: line-through; margin-left: 8px; }

    .btn-add-cart { 
        width: 100%; background: #ecfdf5; border: none; color: var(--primary); padding: 10px; border-radius: 10px; 
        font-weight: 700; font-size: 0.9rem; transition: 0.2s; margin-top: auto; 
    }
    .btn-add-cart:hover { background: var(--primary); color: white; }

</style>
@endsection

@section('content')

<div class="container py-5">
    <div class="row">
        
        <div class="col-lg-3 mb-4">
            <div class="filter-sidebar shadow-sm">
                
                <div class="filter-group">
                    <span class="filter-title">SEARCH</span>
                    <div class="position-relative">
                        <input type="text" class="form-control rounded-pill border-secondary-subtle ps-4" placeholder="Find medicines...">
                        <i class="fas fa-search position-absolute top-50 end-0 translate-middle-y me-3 text-muted"></i>
                    </div>
                </div>

                <div class="filter-group">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="filter-title m-0">MAX PRICE</span>
                        <span class="badge bg-success bg-opacity-10 text-success fw-bold" id="currentPrice">$50</span>
                    </div>
                    
                    <input type="range" class="styled-range" min="0" max="100" value="50" oninput="document.getElementById('currentPrice').innerText = '$' + this.value">
                    
                    <div class="d-flex justify-content-between small text-muted fw-bold" style="font-size: 0.75rem;">
                        <span>$0</span>
                        <span>$100+</span>
                    </div>
                </div>

                <hr class="text-secondary opacity-25 my-4">

                <div class="filter-group">
                    <span class="filter-title">CATEGORY</span>
                    <label class="custom-check"><input type="checkbox" checked> All Medicines</label>
                    <label class="custom-check"><input type="checkbox"> Pain Relief</label>
                    <label class="custom-check"><input type="checkbox"> Antibiotics</label>
                </div>

                <div class="filter-group">
                    <span class="filter-title">FORM</span>
                    <label class="custom-check"><input type="checkbox"> Tablet / Capsule</label>
                    <label class="custom-check"><input type="checkbox"> Syrup / Liquid</label>
                    <label class="custom-check"><input type="checkbox"> Injections</label>
                </div>

                <button class="btn btn-dark w-100 rounded-pill fw-bold py-2 mt-2">Apply Filters</button>
            </div>
        </div>

        <div class="col-lg-9">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold m-0 text-dark">Medicines <span class="text-muted fw-normal fs-6 ms-2">(124 Items)</span></h4>
                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted small fw-bold d-none d-md-block">SORT BY:</span>
                    <select class="form-select form-select-sm w-auto border-0 bg-white shadow-sm fw-bold text-dark" style="cursor: pointer;">
                        <option>Popularity</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                        <option>Newest First</option>
                    </select>
                </div>
            </div>

            <div class="row g-4">
                
                <div class="col-md-4 col-6">
                    <div class="product-card">
                        <div class="prod-img-wrap">
                            <span class="badge-otc">OTC</span>
                            <span class="badge-new">NEW</span>
                            <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=300" class="prod-img" alt="Med">
                        </div>
                        <div class="card-body">
                            <div class="med-name" title="Paracetamol 500mg">Paracetamol 500mg</div>
                            <span class="med-dose">Strip of 10 Tablets</span>
                            <div class="d-flex align-items-center mb-3">
                                <span class="price-tag">$2.50</span>
                                <span class="old-price">$3.00</span>
                            </div>
                            <button class="btn-add-cart"><i class="fas fa-plus me-1"></i> Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-6">
                    <div class="product-card">
                        <div class="prod-img-wrap">
                            <span class="badge-rx">Rx REQUIRED</span>
                            <img src="https://images.unsplash.com/photo-1585435557343-3b092031a831?w=300" class="prod-img" alt="Med">
                        </div>
                        <div class="card-body">
                            <div class="med-name" title="Amoxicillin 500mg">Amoxicillin 500mg</div>
                            <span class="med-dose">Strip of 6 Capsules</span>
                            <div class="d-flex align-items-center mb-3">
                                <span class="price-tag">$12.99</span>
                            </div>
                            <button class="btn-add-cart"><i class="fas fa-file-medical me-1"></i> Order with Rx</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-6">
                    <div class="product-card">
                        <div class="prod-img-wrap">
                            <span class="badge-otc">OTC</span>
                            <span class="badge-new">NEW</span>
                            <img src="https://images.unsplash.com/photo-1631549916768-4119b2d3f9e2?w=300" class="prod-img" alt="Med">
                        </div>
                        <div class="card-body">
                            <div class="med-name">Benadryl Cough Syrup</div>
                            <span class="med-dose">100ml Bottle</span>
                            <div class="d-flex align-items-center mb-3">
                                <span class="price-tag">$8.50</span>
                            </div>
                            <button class="btn-add-cart"><i class="fas fa-plus me-1"></i> Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-6">
                    <div class="product-card">
                        <div class="prod-img-wrap">
                            <span class="badge-otc">OTC</span>
                            <img src="https://images.unsplash.com/photo-1550572017-edd951aa8f72?w=300" class="prod-img" alt="Med">
                        </div>
                        <div class="card-body">
                            <div class="med-name">Vitamin C + Zinc</div>
                            <span class="med-dose">Bottle of 30 Tabs</span>
                            <div class="d-flex align-items-center mb-3">
                                <span class="price-tag">$15.00</span>
                                <span class="old-price">$18.00</span>
                            </div>
                            <button class="btn-add-cart"><i class="fas fa-plus me-1"></i> Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-6">
                    <div class="product-card">
                        <div class="prod-img-wrap">
                            <span class="badge-rx">Rx REQUIRED</span>
                             <span class="badge-new">NEW</span>
                            <img src="https://images.unsplash.com/photo-1576602976047-174e57a47881?w=300" class="prod-img" alt="Med">
                        </div>
                        <div class="card-body">
                            <div class="med-name">Metformin 500mg</div>
                            <span class="med-dose">Strip of 15 Tablets</span>
                            <div class="d-flex align-items-center mb-3">
                                <span class="price-tag">$6.25</span>
                            </div>
                            <button class="btn-add-cart"><i class="fas fa-file-medical me-1"></i> Order with Rx</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-6">
                    <div class="product-card">
                        <div class="prod-img-wrap">
                            <span class="badge-otc">OTC</span>
                            <img src="https://images.unsplash.com/photo-1628771065518-0d82f1938462?w=300" class="prod-img" alt="Med">
                        </div>
                        <div class="card-body">
                            <div class="med-name">Disprin Soluble</div>
                            <span class="med-dose">Strip of 10 Tablets</span>
                            <div class="d-flex align-items-center mb-3">
                                <span class="price-tag">$1.50</span>
                            </div>
                            <button class="btn-add-cart"><i class="fas fa-plus me-1"></i> Add to Cart</button>
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="mt-5 text-center">
                 <button class="btn btn-outline-dark rounded-pill px-5 py-2 fw-bold">Load More Items</button>
            </div>

        </div>
    </div>
</div>

@endsection