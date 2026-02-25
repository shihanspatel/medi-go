<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Medi-Go')</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f8fafc;
            margin: 0;
        }

        .master-nav {
            background: white;
            padding: 12px 0;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 22px;
            color: #059669 !important;
        }

        .navbar-brand:hover {
            color: #047857 !important;
        }

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

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid #e2e8f0;
        }

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

        .btn-login {
            border: 2px solid #059669;
            color: #059669;
            padding: 7px 20px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
        }

        .btn-login:hover {
            background: #059669;
            color: white;
        }

        .btn-register {
            background: #059669;
            color: white;
            padding: 7px 20px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
        }

        .btn-register:hover {
            background: #047857;
        }
    </style>

    @yield('styles')
</head>

<body>

    <nav class="navbar navbar-expand-lg master-nav sticky-top">
        <div class="container">

            {{-- LOGO --}}
            <a class="navbar-brand" href="{{ route('home') }}">
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
                <div class="search-wrapper mx-auto my-3 my-lg-0">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text"
                        class="form-control search-input"
                        placeholder="Search medicines...">
                </div>

                <div class="d-flex align-items-center gap-3">

                    <a href="{{ url('/about') }}" class="nav-text-link">
                        About Us
                    </a>

                    <a href="{{ url('/contact-us') }}" class="nav-text-link">
                        Contact Us
                    </a>

                    {{-- AUTH CHECK --}}
                    @auth

                    @php
                    $user = auth()->user();
                    @endphp

                    <div class="dropdown">

                        <a class="d-flex align-items-center gap-2 text-decoration-none"
                            data-bs-toggle="dropdown"
                            style="cursor:pointer;">

                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=059669&color=fff"
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
                                <a href="{{ route('profile') }}"
                                    class="dropdown-item-custom">
                                    <i class="fas fa-user"></i> My Profile
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('wishlist.index') }}"
                                    class="dropdown-item-custom d-flex justify-content-between align-items-center">
                                    <span>
                                        <i class="fas fa-heart text-danger"></i> Wishlist
                                    </span>
                                    <span class="badge bg-danger rounded-pill">
                                        {{ $wishlistCount }}
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
                                        {{ $cartCount }}
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

                    <a href="{{ route('login') }}" class="btn-login">
                        Login
                    </a>

                    <a href="{{ route('register') }}" class="btn-register">
                        Sign Up
                    </a>

                    @endauth

                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>