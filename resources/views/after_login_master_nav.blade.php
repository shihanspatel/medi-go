<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Medi-Go')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* --- 1. Global Variables & Reset --- */
        :root {
            --primary: #059669;
            --primary-dark: #047857;
            --dark: #0f172a;
            --light: #f8fafc;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: white;
        }

        /* --- 2. Navbar Styles --- */
        .master-nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 12px 0;
            z-index: 1030;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--primary) !important;
            letter-spacing: -0.5px;
        }

        /* Search Bar */
        .search-wrapper {
            position: relative;
            width: 100%;
            max-width: 400px;
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        .search-input {
            padding-left: 45px;
            border-radius: 50px;
            border: 2px solid #f1f5f9;
            background: #f1f5f9;
            transition: 0.3s;
        }

        .search-input:focus {
            background: white;
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.1);
        }

        /* NEW STYLE: Text Links (About/Contact) */
        .nav-text-link {
            font-weight: 600;
            color: var(--dark);
            text-decoration: none;
            font-size: 0.95rem;
            transition: 0.3s;
            white-space: nowrap;
        }
        .nav-text-link:hover {
            color: var(--primary);
        }

        /* Hamburger Toggler */
        .navbar-toggler {
            border: none;
            padding: 0;
            width: 30px;
            height: 24px;
            position: relative;
            outline: none !important;
            box-shadow: none !important;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .navbar-toggler span {
            display: block;
            width: 100%;
            height: 3px;
            background-color: var(--dark);
            border-radius: 4px;
            transition: all 0.4s cubic-bezier(0.68, -0.6, 0.32, 1.6);
            transform-origin: center;
        }

        .navbar-toggler.open span:nth-of-type(1) { transform: translateY(10px) rotate(45deg); background-color: var(--primary); }
        .navbar-toggler.open span:nth-of-type(2) { opacity: 0; transform: scale(0); }
        .navbar-toggler.open span:nth-of-type(3) { transform: translateY(-11px) rotate(-45deg); background-color: var(--primary); }

        /* User Dropdown */
        .user-dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 5px 10px 5px 5px;
            border-radius: 50px;
            transition: 0.3s;
            text-decoration: none;
            color: var(--dark);
            border: 1px solid transparent;
        }
        .user-dropdown-toggle:hover, .user-dropdown-toggle.show {
            background: #f8fafc;
            border-color: #f1f5f9;
        }
        
        .user-avatar {
            width: 38px;
            height: 38px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #e2e8f0;
        }

        /* Custom Dropdown Menu */
        .dropdown-menu-custom {
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-radius: 16px;
            padding: 10px;
            margin-top: 15px !important;
            min-width: 220px;
        }
        
        .dropdown-item-custom {
            border-radius: 8px;
            padding: 10px 15px;
            font-weight: 600;
            font-size: 0.9rem;
            color: #475569;
            transition: 0.2s;
        }
        .dropdown-item-custom:hover {
            background: #f1f5f9;
            color: var(--primary);
        }
        .dropdown-item-custom i {
            width: 20px;
            text-align: center;
            margin-right: 10px;
        }
        .dropdown-divider {
            margin: 8px 0;
            border-color: #f1f5f9;
        }

        /* --- 4. Footer Utilities --- */
        .hover-white:hover { color: #fff !important; transition: 0.3s; padding-left: 5px; }
        footer { margin-top: auto; }

        /* Mobile Adjustments */
        @media (max-width: 991px) {
            .navbar-collapse.show {
                background: white;
                padding: 20px;
                border-radius: 20px;
                margin-top: 15px;
                box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
                border: 1px solid #f1f5f9;
            }
            .search-wrapper { margin-bottom: 20px; max-width: 100%; }
            .d-flex.align-items-center.gap-4 { width: 100%; flex-direction: column; gap: 15px !important; margin-top: 15px; }
            .nav-text-link { width: 100%; text-align: center; padding: 10px; display: block; background: #f8fafc; border-radius: 10px; }
            .user-dropdown-toggle { width: 100%; justify-content: center; background: #f8fafc; padding: 10px; border-radius: 10px; }
        }
    </style>
    @yield('styles')
</head>

<body>

    <nav class="navbar navbar-expand-lg master-nav sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/home') }}">
                <i class="fas fa-plus-circle"></i> Medi-Go
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent" id="navbarToggler">
                <span></span><span></span><span></span>
            </button>

            <div class="collapse navbar-collapse" id="navContent">
                
                <div class="search-wrapper mx-auto my-3 my-lg-0">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="form-control search-input" placeholder="Search medicines...">
                </div>

                <div class="d-flex align-items-center gap-4">
                    
                    <a href="{{ url('/about') }}" class="nav-text-link">About Us</a>
                    <a href="{{ url('/contact') }}" class="nav-text-link">Contact Us</a>
                    <div class="dropdown">
                        <a href="#" class="user-dropdown-toggle" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name=John+Doe&background=059669&color=fff" alt="User" class="user-avatar">
                            <div class="d-none d-lg-block text-start">
                                <small class="d-block text-muted" style="font-size: 0.7rem; line-height: 1;">Hello,</small>
                                <span class="fw-bold" style="font-size: 0.9rem;">John Doe</span>
                            </div>
                            <i class="fas fa-chevron-down ms-2 text-muted" style="font-size: 0.8rem;"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-custom" aria-labelledby="userMenu">
                            <li>
                                <div class="px-3 py-2 d-lg-none">
                                    <span class="fw-bold d-block">John Doe</span>
                                    <small class="text-muted">john@example.com</small>
                                </div>
                            </li>
                            <li><a class="dropdown-item dropdown-item-custom" href="{{ url('/profile') }}"><i class="fas fa-user text-muted"></i> My Profile</a></li>
                            <li><a class="dropdown-item dropdown-item-custom" href="{{ url('/order-history') }}"><i class="fas fa-box-open text-muted"></i> My Orders</a></li>
                            <li><a class="dropdown-item dropdown-item-custom" href="{{ url('/cart') }}"><i class="fas fa-shopping-cart text-muted"></i> My Cart</a></li>
                            <li><a class="dropdown-item dropdown-item-custom" href="{{ url('/wishlist') }}"><i class="fas fa-shopping-cart text-muted"></i> My Wishlist</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item dropdown-item-custom text-danger">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-dark text-white pt-5 pb-4">
        <div class="container">
            <div class="row g-4">
                
                <div class="col-lg-4 col-md-6">
                    <h4 class="fw-bold text-white mb-3">Medi-Go <i class="fas fa-plus-circle text-success"></i></h4>
                    <p class="text-secondary small mb-4" style="max-width: 300px;">
                        Your trusted online pharmacy. We deliver 100% genuine medicines, baby care, and wellness products right to your doorstep.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold text-white mb-3">Quick Links</h6>
                    <ul class="list-unstyled small text-secondary">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-white">About Us</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-white">Contact Us</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-white">My Account</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-white">Track Order</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold text-white mb-3">Categories</h6>
                    <ul class="list-unstyled small text-secondary">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-white">Medicines</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-white">Baby Care</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-white">Vitamins</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-white">Devices</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6">
                    <h6 class="fw-bold text-white mb-3">Contact Support</h6>
                    <ul class="list-unstyled small text-secondary mb-4">
                        <li class="mb-2"><i class="fas fa-map-marker-alt text-success me-2"></i> 123 Health Street, Med City, NY</li>
                        <li class="mb-2"><i class="fas fa-phone text-success me-2"></i> +1 (555) 123-4567</li>
                        <li class="mb-2"><i class="fas fa-envelope text-success me-2"></i> support@medigo.com</li>
                    </ul>
                    
                    <h6 class="fw-bold text-white mb-2">Subscribe</h6>
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm bg-dark border-secondary text-white" placeholder="Email Address">
                        <button class="btn btn-success btn-sm"><i class="fas fa-paper-plane"></i></button>
                    </div>
                </div>

            </div>

            <hr class="border-secondary my-4 opacity-25">

            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="small text-secondary mb-0">&copy; 2024 Medi-Go Pharmacy. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                    <i class="fab fa-cc-visa fa-lg text-secondary me-2"></i>
                    <i class="fab fa-cc-mastercard fa-lg text-secondary me-2"></i>
                    <i class="fab fa-cc-paypal fa-lg text-secondary me-2"></i>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            offset: 80,
            duration: 800
        });

        document.getElementById('navbarToggler').addEventListener('click', function() {
            this.classList.toggle('open');
        });
    </script>
</body>
</html>