<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title','Medi-Go')</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- FontAwesome --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f8fafc;
            margin: 0;
        }

        /* NAVBAR */
        .master-nav {
            background: white;
            padding: 12px 0;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        }

        /* LOGO */
        .navbar-brand {
            font-weight: 800;
            font-size: 22px;
            color: #059669 !important;
        }

        .navbar-brand:hover {
            color: #047857 !important;
        }

        /* SEARCH */
        .search-wrapper {
            position: relative;
            max-width: 420px;
            width: 100%;
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        .search-input {
            padding-left: 40px;
            border-radius: 50px;
            border: 2px solid #f1f5f9;
            background: #f8fafc;
            height: 42px;
        }

        .search-input:focus {
            background: white;
            border-color: #059669;
            box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.1);
        }

        /* NAV LINKS */
        .nav-text-link {
            font-weight: 600;
            color: #334155;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 8px;
        }

        .nav-text-link:hover {
            color: #059669;
            background: #ecfdf5;
        }

        /* USER AVATAR */
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid #e2e8f0;
        }

        /* DROPDOWN */
        .dropdown-menu-custom {
            border: none;
            border-radius: 15px;
            padding: 10px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
        }

        .dropdown-item-custom {
            display: block;
            padding: 10px;
            border-radius: 8px;
            font-weight: 600;
            color: #334155;
            text-decoration: none;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
        }

        .dropdown-item-custom:hover {
            background: #ecfdf5;
            color: #059669;
        }

        /* LOGIN BUTTONS */
        .glass-pill {
            display: flex;
            overflow: hidden;
            border-radius: 50px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .pill-btn {
            flex: 1;
            padding: 4px 20px;
            font-weight: 700;
            font-size: 0.85rem;
            color: white;
            text-transform: uppercase;
            letter-spacing: .5px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all .3s;
        }

        /* LOGIN */
        .pill-btn.red {
            background: linear-gradient(135deg, #fca5a5, #ef4444);
            border-radius: 50px 0 0 50px;
        }

        .pill-btn.red:hover {
            background: linear-gradient(135deg, #ef4444, #b91c1c);
        }

        /* REGISTER */
        .pill-btn.blue {
            background: linear-gradient(135deg, #93c5fd, #3b82f6);
            border-radius: 0 50px 50px 0;
        }

        .pill-btn.blue:hover {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        }
    </style>

    @yield('styles')

</head>

<body>

    <nav class="navbar navbar-expand-lg master-nav sticky-top">
        <div class="container">

            {{-- LOGO --}}
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-plus-circle"></i> Medi-Go
            </a>

            <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navContent">

                {{-- SEARCH --}}
                <form action="{{ route('products.search') }}" method="GET" class="search-wrapper mx-auto my-3 my-lg-0">

                    <i class="fas fa-search search-icon"></i>

                    <input type="text"
                        name="search"
                        class="form-control search-input"
                        placeholder="Search medicines..."
                        value="{{ request('search') }}">

                </form>

                <div class="d-flex align-items-center gap-3">

                    <a href="{{ url('/about') }}" class="nav-text-link">About Us</a>

                    <a href="{{ url('/contact-us') }}" class="nav-text-link">Contact Us</a>

                    {{-- AUTH CHECK --}}
                    @auth

                    @php
                    $user = auth()->user();
                    @endphp

                    <div class="dropdown">

                        <a class="d-flex align-items-center gap-2 text-decoration-none"
                            data-bs-toggle="dropdown"
                            style="cursor:pointer">

                            <img src="{{ $user->user_image ? asset('images/users/' . $user->user_image) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=059669&color=fff' }}"
                                class="user-avatar">

                            <div class="d-none d-lg-block">
                                <small class="text-muted">Hello,</small><br>
                                <span class="fw-bold">{{ $user->name }}</span>
                            </div>

                        </a>

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-custom">

                            <li class="px-3 py-2 border-bottom">
                                <strong>{{ $user->name }}</strong><br>
                                <small class="text-muted">{{ $user->email }}</small>
                            </li>

                            <li>
                                <a href="{{ route('profile') }}" class="dropdown-item-custom">
                                    <i class="fas fa-user"></i> My Profile
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('orders.index') }}" class="dropdown-item-custom">
                                    <i class="fas fa-box"></i> My Orders
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('wishlist.index') }}"
                                    class="dropdown-item-custom d-flex justify-content-between align-items-center">

                                    <span>
                                        <i class="fas fa-heart text-danger"></i> Wishlist
                                    </span>

                                    <span class="badge bg-danger rounded-pill">
                                        {{ $wishlistCount ?? 0 }}
                                    </span>

                                </a>
                            </li>

                            <li>
                                <a href="{{ route('cart.index') }}"
                                    class="dropdown-item-custom d-flex justify-content-between align-items-center">

                                    <span>
                                        <i class="fas fa-shopping-cart text-success"></i> Cart
                                    </span>

                                    <span class="badge bg-success rounded-pill">
                                        {{ $cartCount ?? 0 }}
                                    </span>

                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <button type="submit"
                                        class="dropdown-item-custom text-danger">

                                        <i class="fas fa-sign-out-alt"></i> Logout

                                    </button>
                                </form>
                            </li>

                        </ul>
                    </div>

                    @else

                    <div class="glass-pill">

                        <a href="{{ route('login') }}" class="pill-btn red ">
                            Log In
                        </a>

                        <a href="{{ route('register') }}" class="pill-btn blue">
                            Sign Up
                        </a>

                    </div>

                    @endauth

                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-dark text-white mt-5 pt-5 pb-4" style="border-top: 1px solid #374151;">
        <div class="container">
            <div class="row g-5 mb-4">
                @foreach($footerData as $item)
                <div class="col-md-3 col-sm-6">
                    <h6 class="fw-bold text-white mb-3">{{ $item->title }}</h6>
                    <p class="text-light small lh-lg">{{ $item->content }}</p>
                </div>
                @endforeach
            </div>

            <hr class="bg-secondary my-4">

            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                    <p class="text-light small mb-0">&copy; 2026 Medi-Go. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="text-light small mb-0">Designed with <i class="fas fa-heart text-danger"></i> by Medi-Go Team</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Confirmation Dialog for Delete Operations
        function confirmDelete(message = 'Are you sure you want to delete this item? This action cannot be undone.') {
            return confirm(message);
        }

        // Toast Notifications
        @if(session('success'))
            showToast('{{ session('success') }}', 'success');
        @endif
        
        @if(session('error'))
            showToast('{{ session('error') }}', 'error');
        @endif

        function showToast(message, type) {
            const bgColor = type === 'success' ? '#10b981' : '#ef4444';
            const icon = type === 'success' ? '✓' : '✕';
            
            const toast = document.createElement('div');
            toast.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${bgColor};
                color: white;
                padding: 16px 24px;
                border-radius: 8px;
                box-shadow: 0 10px 25px rgba(0,0,0,0.2);
                z-index: 9999;
                font-weight: 600;
                animation: slideIn 0.3s ease-out;
                max-width: 400px;
            `;
            toast.innerHTML = `<i class="fas fa-check-circle me-2"></i>${message}`;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.animation = 'slideOut 0.3s ease-out';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
    </script>

    <style>
        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }
    </style>