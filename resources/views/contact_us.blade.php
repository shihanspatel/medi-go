@extends('master_nav')

@section('title', 'Contact Us - Medi-Go')

@section('styles')
<style>
    body {
        background-color: #f8fafc;
    }

    .page-header {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        padding: 60px 0;
        margin-bottom: 50px;
        text-align: center;
        color: white;
    }

    .page-header h1 {
        color: white;
        margin-bottom: 10px;
    }

    .page-header p {
        color: rgba(255,255,255,0.9);
    }

    .contact-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        text-align: center;
        transition: 0.3s;
        border: 1px solid #e5e7eb;
        height: 100%;
    }

    .contact-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        border-color: #059669;
    }

    .icon-box {
        width: 60px;
        height: 60px;
        background: #ecfdf5;
        color: #059669;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin: 0 auto 15px;
    }

    .form-container {
        background: white;
        border-radius: 15px;
        padding: 35px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .map-wrapper {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        height: 100%;
        min-height: 500px;
    }

    .form-control {
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 0.95rem;
    }

    .form-control:focus {
        border-color: #059669;
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
    }

    .btn-submit {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        border: none;
        padding: 14px 30px;
        font-weight: 700;
        transition: 0.3s;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(5, 150, 105, 0.3);
    }
</style>
@endsection

@section('content')

<section class="page-header">
    <div class="container">
        <h1 class="display-5 fw-bold">
            <i class="fas fa-headset me-2"></i>Get in Touch
        </h1>
        <p class="lead mb-0">We're here to help and answer any question you might have</p>
    </div>
</section>

<div class="container pb-5">
    {{-- Contact Info Cards --}}
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="contact-card">
                <div class="icon-box">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h5 class="fw-bold mb-2">Address</h5>
                <p class="text-muted small mb-3">
                    Rajkot, Gujarat<br>India
                </p>
                <a href="#" class="btn btn-sm btn-outline-success rounded-pill fw-bold">
                    View on Map
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="contact-card">
                <div class="icon-box">
                    <i class="fas fa-phone"></i>
                </div>
                <h5 class="fw-bold mb-2">Phone</h5>
                <p class="text-muted small mb-3">
                    Mon - Fri, 9AM - 6PM
                </p>
                <a href="tel:+919876543210" class="btn btn-sm btn-outline-success rounded-pill fw-bold">
                    +91 98765 43210
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="contact-card">
                <div class="icon-box">
                    <i class="fas fa-envelope"></i>
                </div>
                <h5 class="fw-bold mb-2">Email</h5>
                <p class="text-muted small mb-3">
                    We'll reply within 24 hours
                </p>
                <a href="mailto:support@medigo.com" class="btn btn-sm btn-outline-success rounded-pill fw-bold">
                    support@medigo.com
                </a>
            </div>
        </div>
    </div>

    {{-- Form and Map --}}
    <div class="row g-4">
        {{-- Form --}}
        <div class="col-lg-6">
            <div class="form-container">
                <h3 class="fw-bold mb-4">
                    <i class="fas fa-envelope me-2 text-success"></i>Send us a Message
                </h3>

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}">
                    @csrf

                    <div class="mb-3">
                        <input type="text"
                            name="first_name"
                            class="form-control @error('first_name') is-invalid @enderror"
                            placeholder="First Name"
                            value="{{ old('first_name') }}">
                        @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <input type="text"
                            name="last_name"
                            class="form-control"
                            placeholder="Last Name"
                            value="{{ old('last_name') }}">
                    </div>

                    <div class="mb-3">
                        <input type="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="Email Address"
                            value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <input type="tel"
                            name="phone"
                            class="form-control"
                            placeholder="Phone Number"
                            value="{{ old('phone') }}">
                    </div>

                    <div class="mb-3">
                        <textarea name="message"
                            class="form-control @error('message') is-invalid @enderror"
                            rows="5"
                            placeholder="Your Message...">{{ old('message') }}</textarea>
                        @error('message')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success btn-submit w-100 rounded-pill">
                        <i class="fas fa-paper-plane me-2"></i>Send Message
                    </button>
                </form>
            </div>
        </div>

        {{-- Map --}}
        <div class="col-lg-6">
            <div class="map-wrapper">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3671.5054701234567!2d70.80217!3d22.30389!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959ca248b7d5555%3A0x1234567890abcdef!2sRajkot%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1234567890"
                    width="100%"
                    height="500"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </div>
</div>

@endsection
