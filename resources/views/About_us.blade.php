@extends('master_nav')

@section('title', 'About Us - MediSwift')

@section('styles')
<style>
    /* --- HERO SECTION --- */
    .about-hero {
        padding: 100px 0;
        background: radial-gradient(circle at top left, #ecfdf5 0%, #ffffff 60%);
        position: relative;
        overflow: hidden;
    }
    .hero-subtitle {
        font-weight: 700;
        letter-spacing: 1px;
        color: var(--primary);
        text-transform: uppercase;
        font-size: 0.85rem;
        margin-bottom: 15px;
        display: block;
    }
    .hero-img-box {
        position: relative;
        z-index: 1;
    }
    .hero-img-box::before {
        content: '';
        position: absolute;
        width: 120%;
        height: 100%;
        background: url('https://cdn.jsdelivr.net/npm/simple-icons@v5/icons/medapps.svg') no-repeat center;
        opacity: 0.05;
        z-index: -1;
        top: -20px;
        left: -20px;
    }
    
    /* --- STATS SECTION --- */
    .stats-card {
        background: white;
        border: 1px solid #f1f5f9;
        padding: 30px;
        border-radius: 20px;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.05);
        border-color: var(--primary);
    }
    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--primary);
        margin-bottom: 5px;
    }

    /* --- TEAM CARDS (Glass Effect) --- */
    .team-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid #f1f5f9;
        transition: 0.3s;
        position: relative;
    }
    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
    }
    .team-img-wrapper {
        height: 280px;
        overflow: hidden;
        background: #f8fafc;
    }
    .team-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .team-card:hover .team-img {
        transform: scale(1.1);
    }
    .social-overlay {
        position: absolute;
        top: 20px;
        right: 20px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        opacity: 0;
        transform: translateX(20px);
        transition: 0.3s ease;
    }
    .team-card:hover .social-overlay {
        opacity: 1;
        transform: translateX(0);
    }
    .social-btn {
        width: 40px;
        height: 40px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--dark);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        text-decoration: none;
        transition: 0.2s;
    }
    .social-btn:hover {
        background: var(--primary);
        color: white;
    }

    /* --- VALUES SECTION --- */
    .value-icon {
        width: 70px;
        height: 70px;
        background: #ecfdf5;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: var(--primary);
        margin-bottom: 20px;
        transition: 0.3s;
    }
    .value-box:hover .value-icon {
        background: var(--primary);
        color: white;
        transform: rotateY(180deg);
    }
</style>
@endsection

@section('content')

    <section class="about-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <span class="hero-subtitle">About MediSwift</span>
                    <h1 class="display-4 fw-bold mb-4">We are redefining <br><span style="color: var(--primary);">Digital Healthcare.</span></h1>
                    <p class="lead text-secondary mb-4" style="line-height: 1.8;">
                        MediSwift isn't just a pharmacy; it's a promise. A promise to deliver genuine medicines, expert advice, and compassionate care right to your doorstep, instantly.
                    </p>
                    
                    <div class="d-flex gap-4 mt-4">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle text-success me-2 fa-lg"></i>
                            <span class="fw-bold text-dark">FDA Approved</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle text-success me-2 fa-lg"></i>
                            <span class="fw-bold text-dark">100% Genuine</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center mt-5 mt-lg-0" data-aos="fade-left">
                    <div class="hero-img-box">
                        <img src="https://cdni.iconscout.com/illustration/premium/thumb/pharmacist-doing-inventory-check-2942023-2475510.png" class="img-fluid" style="max-height: 450px;" alt="Pharmacist">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container">
            <div class="row g-4">
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="stats-card">
                        <div class="stat-number">50k+</div>
                        <small class="text-muted fw-bold">Happy Customers</small>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="stats-card">
                        <div class="stat-number">10k+</div>
                        <small class="text-muted fw-bold">Medicines Available</small>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="stats-card">
                        <div class="stat-number">24/7</div>
                        <small class="text-muted fw-bold">Support Active</small>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="stats-card">
                        <div class="stat-number">12</div>
                        <small class="text-muted fw-bold">Cities Covered</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" style="background-color: #f8fafc;">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h6 class="text-success fw-bold text-uppercase ls-2">Why Choose Us</h6>
                <h2 class="fw-bold">Healthcare with Integrity</h2>
            </div>

            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="bg-white p-4 rounded-4 shadow-sm h-100 value-box">
                        <div class="value-icon"><i class="fas fa-shipping-fast"></i></div>
                        <h4 class="fw-bold mb-3">Lightning Delivery</h4>
                        <p class="text-secondary">We understand that health can't wait. Our logistics network ensures delivery within 24 hours.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-white p-4 rounded-4 shadow-sm h-100 value-box">
                        <div class="value-icon"><i class="fas fa-shield-virus"></i></div>
                        <h4 class="fw-bold mb-3">Safety First</h4>
                        <p class="text-secondary">All products are sanitized and packed in cold-chain storage to maintain maximum potency.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="bg-white p-4 rounded-4 shadow-sm h-100 value-box">
                        <div class="value-icon"><i class="fas fa-hand-holding-heart"></i></div>
                        <h4 class="fw-bold mb-3">Expert Care</h4>
                        <p class="text-secondary">Our licensed pharmacists are just a click away to verify prescriptions and answer queries.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-5" data-aos="fade-up">
                <div>
                    <h6 class="text-success fw-bold text-uppercase">Our Team</h6>
                    <h2 class="fw-bold mb-0">Meet the Experts</h2>
                </div>
                <button class="btn btn-outline-dark rounded-pill fw-bold">Join our Team</button>
            </div>

            <div class="row g-4">
                <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="team-card">
                        <div class="team-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&q=80&w=400" class="team-img" alt="Doctor">
                        </div>
                        <div class="social-overlay">
                            <a href="#" class="social-btn"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="social-btn"><i class="fab fa-twitter"></i></a>
                        </div>
                        <div class="p-3 text-center">
                            <h5 class="fw-bold mb-1">Dr. Sarah Smith</h5>
                            <small class="text-muted">Chief Pharmacist</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="team-card">
                        <div class="team-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?auto=format&fit=crop&q=80&w=400" class="team-img" alt="Doctor">
                        </div>
                        <div class="social-overlay">
                            <a href="#" target="_blank" class="social-btn"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="social-btn"><i class="fab fa-twitter"></i></a>
                        </div>
                        <div class="p-3 text-center">
                            <h5 class="fw-bold mb-1">Dr. James Doe</h5>
                            <small class="text-muted">Head of Operations</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-delay="300">
                    <div class="team-card">
                        <div class="team-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1594824476967-48c8b964273f?auto=format&fit=crop&q=80&w=400" class="team-img" alt="Doctor">
                        </div>
                        <div class="social-overlay">
                            <a href="#" class="social-btn"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="social-btn"><i class="fab fa-twitter"></i></a>
                        </div>
                        <div class="p-3 text-center">
                            <h5 class="fw-bold mb-1">Emily Clark</h5>
                            <small class="text-muted">Senior Nutritionist</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-delay="400">
                    <div class="team-card">
                        <div class="team-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1622253692010-333f2da6031d?auto=format&fit=crop&q=80&w=400" class="team-img" alt="Doctor">
                        </div>
                        <div class="social-overlay">
                            <a href="#" class="social-btn"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="social-btn"><i class="fab fa-twitter"></i></a>
                        </div>
                        <div class="p-3 text-center">
                            <h5 class="fw-bold mb-1">Michael Brown</h5>
                            <small class="text-muted">Logistics Head</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 mb-5">
    <div class="container" data-aos="zoom-in">
        <div class="bg-primary text-white p-5 rounded-5 text-center position-relative overflow-hidden">
            <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
            
            <div class="position-relative z-1">
                <h2 class="fw-bold mb-3">Ready to prioritize your health?</h2>
                <p class="mb-4 text-white-50 w-75 mx-auto">Join over 50,000+ satisfied customers who trust MediSwift for their daily healthcare needs.</p>
                
                <a href="{{ url('/') }}" class="btn btn-light rounded-pill px-5 py-3 fw-bold text-primary shadow-lg">
                    Start Shopping Now
                </a>
                
            </div>
        </div>
    </div>
</section>

@endsection