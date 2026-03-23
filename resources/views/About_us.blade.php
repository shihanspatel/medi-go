@extends('master_nav')

@section('title', 'About Us - Medi-Go')

@section('styles')
<style>
    :root {
        --primary: #059669;
        --primary-dark: #047857;
        --dark: #1e293b;
    }

    /* ================= HERO ================= */

    .about-hero {
        padding: 100px 0;
        background: radial-gradient(circle at top left, #ecfdf5 0%, #ffffff 60%);
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
    }

    .hero-img {
        max-height: 420px;
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-12px);
        }

    }

    /* ================= STATS ================= */

    .stats-card {
        background: white;
        border: 1px solid #f1f5f9;
        padding: 30px;
        border-radius: 20px;
        text-align: center;
        transition: 0.3s;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.05);
        border-color: var(--primary);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--primary);
    }

    /* ================= VALUES ================= */

    .value-box {
        transition: 0.3s;
    }

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
        transition: 0.4s;
    }

    .value-box:hover {
        transform: translateY(-6px);
    }

    .value-box:hover .value-icon {
        background: var(--primary);
        color: white;
        transform: rotateY(180deg);
    }

    /* ================= TEAM ================= */

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
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
    }

    .team-img-wrapper {
        height: 260px;
        overflow: hidden;
    }

    .team-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: 0.5s;
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
        transition: 0.3s;
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
        text-decoration: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .social-btn:hover {
        background: var(--primary);
        color: white;
    }

    /* ================= CTA ================= */

    .cta-section {
        background: linear-gradient(135deg, #059669, #047857);
        color: white;
        border-radius: 40px;
        padding: 60px;
    }

    .cta-btn {
        background: white;
        color: var(--primary);
        padding: 14px 40px;
        border-radius: 50px;
        font-weight: 700;
        text-decoration: none;
        display: inline-block;
        transition: 0.3s;
    }

    .cta-btn:hover {
        background: #ecfdf5;
        transform: translateY(-3px);
    }
</style>
@endsection


@section('content')


{{-- ================= HERO ================= --}}
<section class="about-hero">
    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6">

                <span class="hero-subtitle">
                    {{ $hero->subtitle }}
                </span>

                <h1 class="display-4 fw-bold mb-4">

                    {{ $hero->heading }}

                    <br>

                    <span style="color:var(--primary)">
                        {{ $hero->highlight_text }}
                    </span>

                </h1>

                <p class="lead text-secondary mb-4">
                    {{ $hero->description }}
                </p>

                <div class="d-flex gap-4">

                    <div>
                        <i class="fas fa-check-circle text-success me-2"></i>
                        FDA Approved
                    </div>

                    <div>
                        <i class="fas fa-check-circle text-success me-2"></i>
                        100% Genuine
                    </div>

                </div>

            </div>


            <div class="col-lg-6 text-center mt-5 mt-lg-0">

                <div class="hero-img-box">

                    <img src="{{ asset('images/about/'.$hero->image) }}"
                        class="img-fluid hero-img">

                </div>

            </div>

        </div>

    </div>
</section>



{{-- ================= STATS ================= --}}
<section class="py-5 bg-white">

    <div class="container">

        <div class="row g-4">

            @foreach($stats as $stat)

            <div class="col-6 col-md-3">

                <div class="stats-card">

                    <div class="stat-number">
                        {{ $stat->value }}
                    </div>

                    <small class="text-muted fw-bold">
                        {{ $stat->title }}
                    </small>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</section>



{{-- ================= VALUES ================= --}}
<section class="py-5 bg-light">

    <div class="container">

        <div class="text-center mb-5">

            <h6 class="text-success fw-bold text-uppercase">
                Why Choose Us
            </h6>

            <h2 class="fw-bold">
                Healthcare with Integrity
            </h2>

        </div>


        <div class="row g-4">

            @foreach($values as $value)

            <div class="col-md-4">

                <div class="bg-white p-4 rounded-4 shadow-sm h-100 value-box">

                    <div class="value-icon">
                        <i class="fas {{ $value->icon }}"></i>
                    </div>

                    <h4 class="fw-bold mb-3">
                        {{ $value->title }}
                    </h4>

                    <p class="text-secondary">
                        {{ $value->description }}
                    </p>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</section>



{{-- ================= TEAM ================= --}}
<section class="py-5">

    <div class="container">

        <h2 class="fw-bold mb-5">
            Meet the Experts
        </h2>

        <div class="row g-4">

            @foreach($teams as $team)

            <div class="col-md-3 col-6">

                <div class="team-card">

                    <div class="team-img-wrapper">

                        <img src="{{ asset('images/team/'.$team->image) }}"
                            class="team-img">

                    </div>


                    <div class="social-overlay">

                        @if($team->linkedin)
                        <a href="{{ $team->linkedin }}" class="social-btn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        @endif

                        @if($team->twitter)
                        <a href="{{ $team->twitter }}" class="social-btn">
                            <i class="fab fa-twitter"></i>
                        </a>
                        @endif

                    </div>


                    <div class="p-3 text-center">

                        <h5 class="fw-bold mb-1">
                            {{ $team->name }}
                        </h5>

                        <small class="text-muted">
                            {{ $team->role }}
                        </small>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</section>



{{-- ================= CTA ================= --}}
<section class="py-5 mb-5">

    <div class="container">

        <div class="cta-section text-center">

            <h2 class="fw-bold mb-3">
                {{ $cta->heading }}
            </h2>

            <p class="mb-4 text-white-50 w-75 mx-auto">
                {{ $cta->description }}
            </p>

            <a href="{{ url($cta->button_link) }}" class="cta-btn">
                {{ $cta->button_text }}
            </a>

        </div>

    </div>

</section>

@endsection