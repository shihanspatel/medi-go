@extends('master_nav')

@section('title', 'Medi-Go - Contact Support')

@section('styles')
<style>
    /* --- Page Specific Styles --- */
    body { background-color: #f8fafc; }

    /* 1. Header Section with Pattern */
    .page-header {
        background: radial-gradient(circle at top right, #d1fae5 0%, #ffffff 50%, #f1f5f9 100%);
        padding: 80px 0 50px;
        margin-bottom: 50px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    /* 2. Modern Contact Cards */
    .contact-card {
        background: white;
        border: 1px solid #f1f5f9;
        border-radius: 20px;
        padding: 35px 25px;
        text-align: center;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        height: 100%;
        position: relative;
        z-index: 1;
    }
    .contact-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.06);
        border-color: #d1fae5;
    }
    .icon-box {
        width: 70px;
        height: 70px;
        background: #ecfdf5;
        color: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        margin: 0 auto 25px;
        transition: 0.3s;
        box-shadow: 0 10px 20px rgba(5, 150, 105, 0.1);
    }
    .contact-card:hover .icon-box {
        background: var(--primary);
        color: white;
        transform: scale(1.1) rotate(5deg);
    }

    /* 3. Enhanced Form Styles (SCOPED TO FIX NAVBAR) */
    .form-container {
        background: white;
        border-radius: 24px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.04);
        padding: 40px;
        height: 100%;
        border: 1px solid #f1f5f9;
    }
    
    .form-container .form-label {
        font-weight: 700;
        font-size: 0.85rem;
        color: #475569;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    /* Only apply these styles to inputs INSIDE .form-container */
    .form-container .form-control, 
    .form-container .form-select {
        padding: 14px 18px;
        border-radius: 12px;
        border: 2px solid #f1f5f9;
        background-color: #fcfcfc;
        font-weight: 500;
        font-size: 0.95rem;
        transition: 0.2s;
    }
    
    .form-container .form-control:focus, 
    .form-container .form-select:focus {
        background-color: white;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.1);
    }
    
    /* 4. Map Container */
    .map-wrapper {
        border-radius: 24px;
        overflow: hidden;
        height: 100%;
        min-height: 500px; /* Taller map */
        border: 4px solid white;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    /* 5. Modern FAQ Accordion (Separated Items) */
    .accordion-item { 
        border: 1px solid #f1f5f9; 
        margin-bottom: 15px; 
        background: white; 
        border-radius: 12px !important;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0,0,0,0.01);
    }
    .accordion-button {
        background: white;
        color: #1e293b;
        font-weight: 700;
        padding: 20px;
        box-shadow: none !important;
    }
    .accordion-button:not(.collapsed) {
        background-color: #ecfdf5;
        color: var(--primary);
        border-bottom: 1px solid #d1fae5;
    }
    .accordion-body {
        padding: 20px;
        color: #64748b;
        line-height: 1.6;
    }
    
    /* Decoration Circle */
    .decor-circle {
        position: absolute;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ecfdf5 0%, rgba(255,255,255,0) 70%);
        z-index: 0;
    }
</style>
@endsection

@section('content')

    <section class="page-header">
        <div class="decor-circle" style="top: -100px; left: -100px;"></div>
        <div class="decor-circle" style="bottom: -100px; right: -100px; background: linear-gradient(-135deg, #ecfdf5 0%, rgba(255,255,255,0) 70%);"></div>
        
        <div class="container position-relative z-1">
            <span class="badge bg-white text-success border border-success-subtle mb-3 px-3 py-2 rounded-pill fw-bold shadow-sm">
                <i class="fas fa-headset me-2"></i> 24/7 Support Center
            </span>
            <h1 class="display-4 fw-bold text-dark mb-3 ls-tight">How can we help you?</h1>
            <p class="text-secondary lead mx-auto" style="max-width: 600px;">
                Have a question about your prescription, order status, or our services? Our team is ready to assist you.
            </p>
        </div>
    </section>

    <div class="container pb-5">
        
        <div class="row g-4 mb-5">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
                <div class="contact-card">
                    <div class="icon-box"><i class="fas fa-map-marked-alt"></i></div>
                    <h5 class="fw-bold text-dark mb-2">Main Headquarters</h5>
                    <p class="text-muted mb-3">123 Health Street, Med City,<br>New York, NY 10012</p>
                    <a href="#" class="btn btn-outline-dark rounded-pill btn-sm px-4 fw-bold">Get Directions</a>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="contact-card">
                    <div class="icon-box"><i class="fas fa-headset"></i></div>
                    <h5 class="fw-bold text-dark mb-2">Call Support</h5>
                    <p class="text-muted mb-3">Mon-Fri: 8am - 8pm<br>Sat-Sun: 9am - 5pm</p>
                    <a href="tel:+1555000000" class="btn btn-outline-success rounded-pill btn-sm px-4 fw-bold">+1 (555) 123-4567</a>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="contact-card">
                    <div class="icon-box"><i class="fas fa-envelope-open-text"></i></div>
                    <h5 class="fw-bold text-dark mb-2">Email Us</h5>
                    <p class="text-muted mb-3">Drop us a line anytime.<br>We reply within 24 hours.</p>
                    <a href="mailto:support@medigo.com" class="btn btn-outline-primary rounded-pill btn-sm px-4 fw-bold">support@medigo.com</a>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5 align-items-stretch">
            
            <div class="col-lg-7" data-aos="fade-right">
                <div class="form-container">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-bold m-0">Send us a Message</h3>
                        <small class="text-muted"><i class="fas fa-clock me-1 text-success"></i> Avg. reply: 2 hrs</small>
                    </div>
                    
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" placeholder="John">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" placeholder="Doe">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" placeholder="john@example.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone Number (Optional)</label>
                                <input type="tel" class="form-control" placeholder="+1 (555) ...">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Subject</label>
                                <select class="form-select">
                                    <option selected>General Inquiry</option>
                                    <option>Order Status & Tracking</option>
                                    <option>Prescription Issue</option>
                                    <option>Returns & Refunds</option>
                                    <option>Technical Support</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Message</label>
                                <textarea class="form-control" rows="5" placeholder="Tell us how we can help you..."></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-success w-100 py-3 fw-bold rounded-pill shadow-sm" style="font-size: 1.1rem;">
                                    <i class="fas fa-paper-plane me-2"></i> Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-5" data-aos="fade-left">
                <div class="map-wrapper">
                    <iframe 
                        src="https://maps.google.com/maps?q=New%20York&t=&z=13&ie=UTF8&iwloc=&output=embed" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>

        <div class="row justify-content-center pt-5">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <span class="text-uppercase text-primary fw-bold small letter-spacing-2">Help Center</span>
                    <h3 class="fw-bold mt-2">Frequently Asked Questions</h3>
                </div>

                <div class="accordion" id="faqAccordion">                    
                    <div class="accordion-item" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                <i class="fas fa-globe-americas me-3 text-info"></i> Do you ship internationally?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Currently, Medi-Go only ships within the United States. We are actively working on regulatory compliance to expand our shipping options to Canada and the UK soon.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                <i class="fas fa-undo-alt me-3 text-warning"></i> What is your return policy?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                We offer a 30-day return policy for most unopened items. However, due to health regulations, <strong>prescription medications cannot be returned</strong> once they have left the pharmacy.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" data-aos="fade-up" data-aos-delay="300">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                <i class="fas fa-file-medical me-3 text-danger"></i> Do I need a prescription?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Currently we are selling the medicines which are <strong>not requiring any prescriptions</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection