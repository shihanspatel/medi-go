@extends('after_login_contcat_use')

@section('title', 'Medi-Go - Contact Us')

@section('styles')
<style>
    /* --- Page Specific Styles --- */
    body { background-color: #f8fafc; }

    /* Header Section */
    .page-header {
        background: radial-gradient(circle at top right, #ecfdf5 0%, #ffffff 60%);
        padding: 60px 0 40px;
        margin-bottom: 40px;
        text-align: center;
    }

    /* Contact Info Cards */
    .contact-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 30px 20px;
        text-align: center;
        transition: 0.3s;
        height: 100%;
    }
    .contact-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.05);
        border-color: var(--primary);
    }
    .icon-box {
        width: 60px;
        height: 60px;
        background: #ecfdf5;
        color: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin: 0 auto 20px;
        transition: 0.3s;
    }
    .contact-card:hover .icon-box {
        background: var(--primary);
        color: white;
    }

    /* Form Styles */
    .form-control, .form-select {
        padding: 12px 15px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        background-color: #f8fafc;
    }
    .form-control:focus, .form-select:focus {
        background-color: white;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.1);
    }
    
    /* Map Container */
    .map-container {
        border-radius: 16px;
        overflow: hidden;
        height: 100%;
        min-height: 400px;
        border: 1px solid #e2e8f0;
    }

    /* Accordion (FAQ) */
    .accordion-item { border: none; margin-bottom: 10px; background: transparent; }
    .accordion-button {
        border-radius: 10px !important;
        background: white;
        border: 1px solid #e2e8f0;
        color: var(--dark);
        font-weight: 600;
        box-shadow: none !important;
    }
    .accordion-button:not(.collapsed) {
        background-color: #ecfdf5;
        color: var(--primary);
        border-color: #ecfdf5;
    }
    .accordion-body {
        background: white;
        border: 1px solid #e2e8f0;
        border-top: none;
        border-radius: 0 0 10px 10px;
        margin-top: -5px;
        color: #64748b;
    }
</style>
@endsection

@section('content')

    <section class="page-header">
        <div class="container">
            <span class="badge bg-success bg-opacity-10 text-success border border-success mb-3 px-3 py-2 rounded-pill fw-bold">
                We'd love to hear from you
            </span>
            <h1 class="display-5 fw-bold text-dark mb-3">Get in Touch</h1>
            <p class="text-secondary lead mx-auto" style="max-width: 600px;">
                Have a question about your order, a product, or just want to say hello? Our team is here to help you.
            </p>
        </div>
    </section>

    <div class="container pb-5">
        
        <div class="row g-4 mb-5">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
                <div class="contact-card">
                    <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
                    <h5 class="fw-bold text-dark">Visit Us</h5>
                    <p class="text-muted small">123 Health Street, Med City,<br>New York, NY 10012</p>
                    <a href="#" class="text-decoration-none fw-bold text-success small">Get Directions <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="contact-card">
                    <div class="icon-box"><i class="fas fa-phone-alt"></i></div>
                    <h5 class="fw-bold text-dark">Call Us</h5>
                    <p class="text-muted small">Mon-Fri from 8am to 5pm.<br>Sat-Sun from 9am to 2pm.</p>
                    <a href="tel:+1555000000" class="text-decoration-none fw-bold text-success small">+1 (555) 000-0000</a>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="contact-card">
                    <div class="icon-box"><i class="fas fa-envelope"></i></div>
                    <h5 class="fw-bold text-dark">Email Us</h5>
                    <p class="text-muted small">Send us a query anytime!<br>We usually reply within 24 hours.</p>
                    <a href="mailto:support@medigo.com" class="text-decoration-none fw-bold text-success small">support@medigo.com</a>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-lg-7" data-aos="fade-right">
                <div class="bg-white p-4 p-md-5 rounded-4 border border-secondary-subtle h-100">
                    <h3 class="fw-bold mb-4">Send us a Message</h3>
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">First Name</label>
                                <input type="text" class="form-control" placeholder="John">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">Last Name</label>
                                <input type="text" class="form-control" placeholder="Doe">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold small text-muted">Email Address</label>
                                <input type="email" class="form-control" placeholder="john@example.com">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold small text-muted">Subject</label>
                                <select class="form-select">
                                    <option selected>General Inquiry</option>
                                    <option>Order Status</option>
                                    <option>Product Information</option>
                                    <option>Returns & Refunds</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold small text-muted">Message</label>
                                <textarea class="form-control" rows="5" placeholder="How can we help you?"></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-success w-100 py-3 fw-bold rounded-pill">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-5" data-aos="fade-left">
                <div class="map-container shadow-sm">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.1422937950147!2d-73.98731968482413!3d40.75889497932681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes+Square!5e0!3m2!1sen!2sus!4v1510522332167" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-4">
                    <h3 class="fw-bold">Frequently Asked Questions</h3>
                    <p class="text-muted">Quick answers to common questions.</p>
                </div>

                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item" data-aos="fade-up">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                How can I track my order?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                You can track your order by clicking on "My Account" in the navbar and selecting "Track Order". Alternatively, use the tracking link sent to your email.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Do you ship internationally?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Currently, we only ship within the United States. We are working on expanding our shipping options to international locations soon.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                What is your return policy?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                We accept returns for unopened and unused products within 30 days of purchase. Prescription medicines cannot be returned due to safety regulations.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection