@extends('after_login_master_nav')

@section('title', 'Paracetamol 500mg - Medi-Go')

@section('styles')
<style>
    body { background-color: #f8fafc; }

    /* --- Product Gallery --- */
    .main-img-box {
        background: white;
        border-radius: 20px;
        border: 1px solid #f1f5f9;
        height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }
    .main-img { max-height: 300px; max-width: 90%; object-fit: contain; transition: 0.3s; }
    .main-img:hover { transform: scale(1.05); }
    
    .thumb-gallery { display: flex; gap: 10px; margin-top: 15px; }
    .thumb-btn {
        width: 70px;
        height: 70px;
        border: 2px solid transparent;
        border-radius: 12px;
        background: white;
        padding: 5px;
        cursor: pointer;
        transition: 0.2s;
    }
    .thumb-btn.active, .thumb-btn:hover { border-color: var(--primary); }
    .thumb-img { width: 100%; height: 100%; object-fit: contain; }

    /* --- Product Info --- */
    .product-title { font-weight: 800; color: var(--dark); margin-bottom: 10px; }
    .product-price { font-size: 2rem; font-weight: 800; color: var(--primary); display: flex; align-items: center; gap: 10px; }
    .old-price { font-size: 1.2rem; color: #94a3b8; text-decoration: line-through; font-weight: 600; }
    
    /* Quantity Input */
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
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: 0.2s;
    }
    .qty-btn:hover { background: var(--primary); color: white; }
    .qty-val { width: 40px; text-align: center; border: none; font-weight: 700; background: transparent; }
    .qty-val:focus { outline: none; }

    /* --- Tabs --- */
    .custom-tabs .nav-link {
        color: #64748b;
        font-weight: 700;
        border: none;
        border-bottom: 3px solid transparent;
        padding: 15px 25px;
        background: transparent;
    }
    .custom-tabs .nav-link:hover { color: var(--primary); }
    .custom-tabs .nav-link.active {
        color: var(--primary);
        border-bottom-color: var(--primary);
        background: transparent;
    }

    /* --- Reviews Section --- */
    .rating-box {
        background: white;
        border-radius: 16px;
        padding: 30px;
        border: 1px solid #f1f5f9;
        height: 100%;
    }
    .big-rating { font-size: 3.5rem; font-weight: 800; color: var(--dark); line-height: 1; }
    .star-yellow { color: #fbbf24; }
    .star-gray { color: #e2e8f0; }
    
    /* Progress Bars */
    .progress { height: 8px; border-radius: 10px; background-color: #f1f5f9; }
    .progress-bar { background-color: #fbbf24; border-radius: 10px; }

    /* Individual Review */
    .review-card {
        border-bottom: 1px solid #f1f5f9;
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
            <div class="col-lg-6" data-aos="fade-right">
                <div class="main-img-box mb-3">
                    <span class="badge bg-danger position-absolute top-0 start-0 m-4 px-3 py-2 fw-bold">10% OFF</span>
                    <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=500" class="main-img" id="mainImage" alt="Product">
                </div>
                <div class="thumb-gallery">
                    <div class="thumb-btn active" onclick="changeImage(this, 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=500')">
                        <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=100" class="thumb-img">
                    </div>
                    <div class="thumb-btn" onclick="changeImage(this, 'https://images.unsplash.com/photo-1585435557343-3b092031a831?w=500')">
                        <img src="https://images.unsplash.com/photo-1585435557343-3b092031a831?w=100" class="thumb-img">
                    </div>
                    <div class="thumb-btn" onclick="changeImage(this, 'https://images.unsplash.com/photo-1628771065518-0d82f1938462?w=500')">
                        <img src="https://images.unsplash.com/photo-1628771065518-0d82f1938462?w=100" class="thumb-img">
                    </div>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <div class="ps-lg-4">
                    <span class="badge bg-success bg-opacity-10 text-success fw-bold mb-2">In Stock</span>
                    <h1 class="product-title">Paracetamol 500mg Tablets</h1>
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-2 text-warning">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="text-muted small fw-bold">(128 Reviews)</span>
                    </div>

                    <p class="text-secondary mb-4">
                        Effective pain relief for headaches, muscle aches, arthritis, backache, toothaches, colds, and fevers. Fast-acting formula.
                    </p>

                    <div class="product-price mb-4">
                        $5.00 <span class="old-price">$6.50</span>
                    </div>

                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="qty-wrapper">
                            <button class="qty-btn" onclick="this.nextElementSibling.stepDown()"><i class="fas fa-minus"></i></button>
                            <input type="number" class="qty-val" value="1" min="1" readonly>
                            <button class="qty-btn" onclick="this.previousElementSibling.stepUp()"><i class="fas fa-plus"></i></button>
                        </div>
                        <button class="btn btn-success rounded-pill px-5 py-2 fw-bold shadow-lg">
                            <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                        </button>
                        <button class="btn btn-outline-dark rounded-circle p-2" style="width: 45px; height: 45px;">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>

                    <div class="border-top pt-4">
                        <div class="d-flex mb-2">
                            <span class="text-muted fw-bold" style="width: 100px;">SKU:</span>
                            <span class="fw-semibold">MG-99281</span>
                        </div>
                        <div class="d-flex mb-2">
                            <span class="text-muted fw-bold" style="width: 100px;">Category:</span>
                            <span class="text-success fw-bold">Pain Relief</span>
                        </div>
                        <div class="d-flex">
                            <span class="text-muted fw-bold" style="width: 100px;">Tags:</span>
                            <span class="text-secondary small">Fever, Headache, Body Pain</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs custom-tabs mb-4" id="myTab" role="tablist">
                    <li class="nav-item"><button class="nav-link active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc">Description</button></li>
                    <li class="nav-item"><button class="nav-link" id="ingredients-tab" data-bs-toggle="tab" data-bs-target="#ingredients">Ingredients</button></li>
                    <li class="nav-item"><button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews">Reviews (128)</button></li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="desc">
                        <div class="bg-white p-4 rounded-4 border border-light">
                            <h5 class="fw-bold mb-3">Product Details</h5>
                            <p class="text-muted">Paracetamol is a common painkiller used to treat aches and pain. It can also be used to reduce a high temperature. It's available combined with other painkillers and anti-sickness medicines. It's also an ingredient in a wide range of cold and flu remedies.</p>
                            <h6 class="fw-bold mt-4">Key Benefits:</h6>
                            <ul class="text-muted">
                                <li>Relieves mild to moderate pain</li>
                                <li>Reduces fever</li>
                                <li>Gentle on the stomach</li>
                            </ul>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="ingredients">
                        <div class="bg-white p-4 rounded-4 border border-light">
                            <table class="table table-borderless w-auto">
                                <tbody>
                                    <tr><td class="fw-bold text-dark">Active Ingredient:</td><td class="text-muted">Paracetamol 500mg</td></tr>
                                    <tr><td class="fw-bold text-dark">Other Ingredients:</td><td class="text-muted">Maize Starch, Potassium Sorbate, Purified Talc, Stearic Acid.</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="reviews">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="rating-box">
                                    <h5 class="fw-bold mb-4">Customer Reviews</h5>
                                    <div class="d-flex align-items-center gap-3 mb-4">
                                        <div class="big-rating">4.5</div>
                                        <div>
                                            <div class="text-warning">
                                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                            </div>
                                            <small class="text-muted fw-bold">Based on 128 reviews</small>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <small class="fw-bold text-muted" style="width: 30px;">5 <i class="fas fa-star text-warning"></i></small>
                                        <div class="progress flex-grow-1"><div class="progress-bar" style="width: 70%"></div></div>
                                        <small class="text-muted">70%</small>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <small class="fw-bold text-muted" style="width: 30px;">4 <i class="fas fa-star text-warning"></i></small>
                                        <div class="progress flex-grow-1"><div class="progress-bar" style="width: 20%"></div></div>
                                        <small class="text-muted">20%</small>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <small class="fw-bold text-muted" style="width: 30px;">3 <i class="fas fa-star text-warning"></i></small>
                                        <div class="progress flex-grow-1"><div class="progress-bar" style="width: 5%"></div></div>
                                        <small class="text-muted">5%</small>
                                    </div>
                                    
                                    <button class="btn btn-outline-dark w-100 rounded-pill mt-4 fw-bold" data-bs-toggle="modal" data-bs-target="#reviewModal">Write a Review</button>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="bg-white p-4 rounded-4 border border-light">
                                    <div class="review-card">
                                        <div class="d-flex justify-content-between mb-2">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="https://ui-avatars.com/api/?name=Alice+W&background=random" class="reviewer-avatar">
                                                <div>
                                                    <h6 class="fw-bold m-0">Alice Williams</h6>
                                                    <div class="text-warning small">
                                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <small class="text-muted">2 days ago</small>
                                        </div>
                                        <p class="text-secondary">Excellent service! The medicine arrived very quickly and was exactly what I ordered. Packaging was secure.</p>
                                    </div>

                                    <div class="review-card">
                                        <div class="d-flex justify-content-between mb-2">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="https://ui-avatars.com/api/?name=John+D&background=random" class="reviewer-avatar">
                                                <div>
                                                    <h6 class="fw-bold m-0">John Doe</h6>
                                                    <div class="text-warning small">
                                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <small class="text-muted">1 week ago</small>
                                        </div>
                                        <p class="text-secondary">Good product, but the delivery was a day later than expected.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="reviewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Write a Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body pt-2">
                    <form>
                        <div class="mb-3 text-center">
                            <label class="form-label d-block text-muted small fw-bold">HOW WOULD YOU RATE IT?</label>
                            <div class="fs-2 text-warning cursor-pointer">
                                <i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Review Title</label>
                            <input type="text" class="form-control rounded-3" placeholder="e.g. Great product!">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Your Review</label>
                            <textarea class="form-control rounded-3" rows="4" placeholder="Tell us about your experience..."></textarea>
                        </div>
                        <button type="button" class="btn btn-success w-100 rounded-pill fw-bold">Submit Review</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simple Image Switcher Script
        function changeImage(element, src) {
            document.getElementById('mainImage').src = src;
            document.querySelectorAll('.thumb-btn').forEach(btn => btn.classList.remove('active'));
            element.classList.add('active');
        }
    </script>

@endsection