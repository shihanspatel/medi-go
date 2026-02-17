@extends('master_nav')

@section('title', 'Contact Us - Medi-Go')

@section('styles')
<style>
    body {
        background-color: #f8fafc;
    }

    .page-header {
        background: radial-gradient(circle at top right, #d1fae5 0%, #ffffff 50%, #f1f5f9 100%);
        padding: 80px 0 50px;
        margin-bottom: 50px;
        text-align: center;
        position: relative;
    }

    .contact-card {
        background: white;
        border-radius: 20px;
        padding: 35px 25px;
        text-align: center;
        transition: 0.3s;
        border: 1px solid #f1f5f9;
    }

    .contact-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.06);
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
        margin: 0 auto 20px;
    }

    .form-container {
        background: white;
        border-radius: 24px;
        padding: 40px;
        border: 1px solid #f1f5f9;
    }

    .map-wrapper {
        border-radius: 24px;
        overflow: hidden;
        min-height: 500px;
    }
</style>
@endsection


@section('content')

<section class="page-header">
    <div class="container">
        <span class="badge bg-white text-success border border-success px-3 py-2 rounded-pill fw-bold">
            <i class="fas fa-headset me-2"></i>
            {{ $contact->badge_text }}
        </span>
        <h1 class="display-4 fw-bold mt-3">
            {{ $contact->heading }}
        </h1>
        <p class="text-secondary lead">
            {{ $contact->subheading }}
        </p>
    </div>
</section>

<div class="container pb-5">
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="contact-card">
                <div class="icon-box">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h5 class="fw-bold">
                    {{ $contact->address_title }}
                </h5>
                <p class="text-muted">
                    {!! nl2br(e($contact->address)) !!}
                </p>
                <a href="{{ $contact->address_link }}"
                    class="btn btn-outline-dark rounded-pill btn-sm px-4 fw-bold">
                    {{ $contact->address_button_text }}
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="contact-card">
                <div class="icon-box">
                    <i class="fas fa-phone"></i>
                </div>
                <h5 class="fw-bold">
                    {{ $contact->phone_title }}
                </h5>
                <p class="text-muted">
                    {{ $contact->phone_hours }}
                </p>
                <a href="tel:{{ $contact->phone }}"
                    class="btn btn-outline-success rounded-pill btn-sm px-4 fw-bold">
                    {{ $contact->phone }}
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="contact-card">
                <div class="icon-box">
                    <i class="fas fa-envelope"></i>
                </div>
                <h5 class="fw-bold">
                    {{ $contact->email_title }}
                </h5>
                <p class="text-muted">
                    {{ $contact->email_description }}
                </p>
                <a href="mailto:{{ $contact->email }}"
                    class="btn btn-outline-primary rounded-pill btn-sm px-4 fw-bold">
                    {{ $contact->email }}
                </a>
            </div>
        </div>
    </div>



    <div class="row g-4">
        <div class="col-lg-7">

            <div class="form-container">

                <div class="d-flex justify-content-between mb-4">
                    <h3 class="fw-bold">
                        {{ $contact->form_heading }}
                    </h3>

                    <small class="text-muted">
                        {{ $contact->form_reply_time }}
                    </small>
                </div>


                {{-- SUCCESS MESSAGE --}}
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif


                <form method="POST" action="{{ route('contact.store') }}">
                    @csrf

                    <div class="row g-3">


                        <div class="col-md-6">
                            <input type="text"
                                name="first_name"
                                class="form-control"
                                placeholder="First Name"
                                value="{{ old('first_name') }}">

                            @error('first_name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>



                        <div class="col-md-6">
                            <input type="text"
                                name="last_name"
                                class="form-control"
                                placeholder="Last Name"
                                value="{{ old('last_name') }}">
                        </div>



                        <div class="col-md-6">
                            <input type="email"
                                name="email"
                                class="form-control"
                                placeholder="Email"
                                value="{{ old('email') }}">

                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>



                        <div class="col-md-6">
                            <input type="tel"
                                name="phone"
                                class="form-control"
                                placeholder="Phone"
                                value="{{ old('phone') }}">
                        </div>



                        <div class="col-12">
                            <textarea name="message"
                                class="form-control"
                                rows="5"
                                placeholder="Message">{{ old('message') }}</textarea>

                            @error('message')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>



                        <div class="col-12">

                            <button type="submit"
                                class="btn btn-success w-100 py-3 fw-bold rounded-pill">

                                <i class="fas fa-paper-plane me-2"></i>
                                Send Message

                            </button>

                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>


    <div class="col-lg-5">
        <div class="map-wrapper">
            <iframe
                src="{{ $contact->map_embed }}"
                width="100%"
                height="500"
                style="border:0;"
                loading="lazy">
            </iframe>
        </div>
    </div>
</div>
</div>
@endsection