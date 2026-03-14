<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','MediGo Admin')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #059669;
            --dark: #0f172a;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f8fafc;
        }

        /* ── Sidebar ── */
        .admin-sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(12px);
            border-right: 1px solid rgba(0,0,0,0.07);
            padding: 20px;
            transition: width 0.4s ease;
            z-index: 1000;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .admin-sidebar.collapsed { width: 72px; }
        .admin-sidebar.collapsed .link-text,
        .admin-sidebar.collapsed .admin-logo-text { display: none; }
        .admin-sidebar.collapsed .admin-logo { justify-content: center; }

        .admin-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 30px;
            white-space: nowrap;
        }

        .admin-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: 12px;
            color: var(--dark);
            text-decoration: none;
            margin-bottom: 6px;
            transition: 0.25s;
            font-weight: 600;
            white-space: nowrap;
        }

        .admin-link i { width: 20px; text-align: center; flex-shrink: 0; }

        .admin-link:hover {
            background: #ecfdf5;
            color: var(--primary);
            transform: translateX(4px);
        }

        .admin-link.active {
            background: linear-gradient(135deg,#ecfdf5,#d1fae5);
            color: var(--primary);
        }

        /* ── Topbar ── */
        .admin-topbar {
            position: fixed;
            top: 0;
            left: 260px;
            right: 0;
            height: 65px;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,0.07);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
            transition: left 0.4s ease;
            z-index: 999;
        }

        .admin-topbar.collapsed { left: 72px; }

        /* ── Content ── */
        .admin-content {
            margin-left: 260px;
            margin-top: 65px;
            padding: 25px;
            transition: margin-left 0.4s ease;
            min-height: calc(100vh - 65px);
        }

        .admin-content.collapsed { margin-left: 72px; }

        /* ── Misc ── */
        .admin-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            flex-shrink: 0;
        }

        .toggle-btn { cursor: pointer; font-size: 1.2rem; color: var(--dark); }

        .icon-btn {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #ecfdf5;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            position: relative;
            text-decoration: none;
        }

        .badge-dot {
            position: absolute;
            top: 4px;
            right: 4px;
            background: red;
            width: 9px;
            height: 9px;
            border-radius: 50%;
        }

        .dropdown-menu { z-index: 1060 !important; }

        /* ── Mobile ── */
        .mobile-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 900;
        }
        .mobile-overlay.show { display: block; }

        @media (max-width: 768px) {
            .admin-sidebar { left: -260px; width: 260px !important; }
            .admin-sidebar.show { left: 0; }
            .admin-topbar { left: 0 !important; }
            .admin-content { margin-left: 0 !important; }
        }
    </style>
</head>

<body>

<!-- Mobile Overlay -->
<div class="mobile-overlay" id="overlay" onclick="toggleSidebar()"></div>

<!-- ══ SIDEBAR ══ -->
<div class="admin-sidebar" id="sidebar">

    <div class="admin-logo">
        <i class="fas fa-clinic-medical"></i>
        <span class="admin-logo-text">MediGo</span>
    </div>

    <a href="{{ url('/admin/dashboard') }}" class="admin-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
        <i class="fas fa-home"></i>
        <span class="link-text">Dashboard</span>
    </a>

    <a href="{{ url('/admin/users') }}" class="admin-link {{ request()->is('admin/users') ? 'active' : '' }}">
        <i class="fas fa-users"></i>
        <span class="link-text">Users</span>
    </a>

    <a href="{{ url('/admin/products') }}" class="admin-link {{ request()->is('admin/products') ? 'active' : '' }}">
        <i class="fas fa-pills"></i>
        <span class="link-text">Products</span>
    </a>

    <a href="{{ url('/admin/categories') }}" class="admin-link {{ request()->is('admin/categories') ? 'active' : '' }}">
        <i class="fas fa-layer-group"></i>
        <span class="link-text">Categories</span>
    </a>

    <a href="{{ url('/admin/orders') }}" class="admin-link {{ request()->is('admin/orders') ? 'active' : '' }}">
        <i class="fas fa-shopping-bag"></i>
        <span class="link-text">Orders</span>
    </a>

    <a href="{{ url('/admin/ratings') }}" class="admin-link {{ request()->is('admin/ratings') ? 'active' : '' }}">
        <i class="fas fa-star"></i>
        <span class="link-text">Ratings</span>
    </a>

    <a href="{{ url('/admin/contact') }}" class="admin-link {{ request()->is('admin/contact') ? 'active' : '' }}">
        <i class="fas fa-headset"></i>
        <span class="link-text">Contact Us</span>
    </a>

    <a href="{{ url('/admin/cart') }}" class="admin-link {{ request()->is('admin/cart') ? 'active' : '' }}">
        <i class="fas fa-shopping-cart"></i>
        <span class="link-text">Cart</span>
    </a>

    <a href="{{ url('/admin/wishlist') }}" class="admin-link {{ request()->is('admin/wishlist') ? 'active' : '' }}">
        <i class="fas fa-heart"></i>
        <span class="link-text">Wishlist</span>
    </a>

    <hr>

    <a href="{{ route('logout') }}" class="admin-link text-danger"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i>
        <span class="link-text">Logout</span>
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>

</div>

<!-- ══ TOPBAR ══ -->
<div class="admin-topbar" id="topbar">
    <div class="d-flex align-items-center gap-3">
        <i class="fas fa-bars toggle-btn" onclick="toggleSidebar()"></i>
        <h5 class="mb-0 fw-bold">@yield('page-title','Dashboard')</h5>
    </div>

    <div class="d-flex align-items-center gap-3">
        <div class="dropdown">
            <button class="btn d-flex align-items-center gap-2 dropdown-toggle p-0 border-0 bg-transparent"
                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="admin-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <span class="fw-bold d-none d-md-inline">{{ Auth::user()->name }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                <li>
                    <a class="dropdown-item" href="{{ url('/admin/profile') }}">
                        <i class="fas fa-user me-2"></i> Profile
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- ══ CONTENT ══ -->
<div class="admin-content" id="content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const topbar  = document.getElementById('topbar');
        const content = document.getElementById('content');
        const overlay = document.getElementById('overlay');

        if (window.innerWidth > 768) {
            sidebar.classList.toggle('collapsed');
            topbar.classList.toggle('collapsed');
            content.classList.toggle('collapsed');
        } else {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        }
    }

    // Close sidebar on mobile link click
    document.querySelectorAll('.admin-link').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                document.getElementById('sidebar').classList.remove('show');
                document.getElementById('overlay').classList.remove('show');
            }
        });
    });
</script>

</body>
</html>
