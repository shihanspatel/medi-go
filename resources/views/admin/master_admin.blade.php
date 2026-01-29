<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','MediSwift Admin')</title>

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

        /* Sidebar */
        .admin-sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(12px);
            border-right: 1px solid rgba(0,0,0,0.05);
            padding: 20px;
            transition: 0.4s ease;
            z-index: 1000;
        }

        .admin-sidebar.collapsed { width: 90px; }
        .admin-sidebar.collapsed .link-text { display: none; }

        .admin-logo {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 30px;
        }

        .admin-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            border-radius: 12px;
            color: var(--dark);
            text-decoration: none;
            margin-bottom: 10px;
            transition: 0.3s;
            font-weight: 600;
        }

        .admin-link i { width: 22px; text-align: center; }

        .admin-link:hover {
            background: #ecfdf5;
            color: var(--primary);
            transform: translateX(5px);
        }

        .admin-link.active {
            background: linear-gradient(135deg, #ecfdf5, #d1fae5);
            color: var(--primary);
        }

        /* Topbar */
        .admin-topbar {
            margin-left: 260px;
            height: 70px;
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
            transition: 0.4s;
        }

        .admin-topbar.collapsed { margin-left: 90px; }

        .admin-content {
            margin-left: 260px;
            padding: 25px;
            transition: 0.4s;
        }

        .admin-content.collapsed { margin-left: 90px; }

        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
        }

        .toggle-btn { cursor: pointer; font-size: 1.3rem; }

        .icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #ecfdf5;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            position: relative;
            cursor: pointer;
        }

        .badge-dot {
            position: absolute;
            top: 5px;
            right: 5px;
            background: red;
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="admin-sidebar" id="sidebar">
    <div class="admin-logo">
        <i class="fas fa-plus-circle"></i>
        <span class="link-text"> MediGo</span>
    </div>

    <a href="{{ url('/admin/dashboard') }}" class="admin-link active">
        <i class="fas fa-home"></i>
        <span class="link-text">Dashboard</span>
    </a>

    <a href="#" class="admin-link">
        <i class="fas fa-users"></i>
        <span class="link-text">Users</span>
    </a>

    <a href="#" class="admin-link">
        <i class="fas fa-pills"></i>
        <span class="link-text">Products</span>
    </a>

    <a href="#" class="admin-link">
        <i class="fas fa-layer-group"></i>
        <span class="link-text">Categories</span>
    </a>

    <a href="#" class="admin-link">
        <i class="fas fa-tags"></i>
        <span class="link-text">Offers</span>
    </a>

    <a href="#" class="admin-link">
        <i class="fas fa-shopping-bag"></i>
        <span class="link-text">Orders</span>
    </a>

    <a href="#" class="admin-link">
        <i class="fas fa-star"></i>
        <span class="link-text">Ratings</span>
    </a>

    <a href="#" class="admin-link">
        <i class="fas fa-headset"></i>
        <span class="link-text">Contact Us</span>
    </a>

    <hr>

    <a href="{{ route('logout') }}" class="admin-link text-danger"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i>
        <span class="link-text">Logout</span>
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
    </form>
</div>

<!-- Topbar -->
<div class="admin-topbar" id="topbar">
    <div class="d-flex align-items-center gap-3">
        <i class="fas fa-bars toggle-btn" onclick="toggleSidebar()"></i>
        <h5 class="mb-0 fw-bold">@yield('page-title','Dashboard')</h5>
    </div>

    <div class="d-flex align-items-center gap-3">

        <!-- Wishlist -->
        <div class="icon-btn" title="Wishlist">
            <i class="fas fa-heart"></i>
            <span class="badge-dot"></span>
        </div>

        <!-- Cart -->
        <div class="icon-btn" title="Cart">
            <i class="fas fa-shopping-cart"></i>
            <span class="badge-dot"></span>
        </div>

        <!-- Profile -->
        <div class="dropdown">
            <div class="d-flex align-items-center gap-2 dropdown-toggle" data-bs-toggle="dropdown" style="cursor:pointer;">
                <div class="admin-avatar">A</div>
                <span class="fw-bold">Admin</span>
            </div>

            <ul class="dropdown-menu dropdown-menu-end shadow">
                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </a>
                </li>
            </ul>
        </div>

    </div>
</div>

<!-- Content -->
<div class="admin-content" id="content">
    @yield('content')
</div>

<script>
function toggleSidebar() {
    sidebar.classList.toggle('collapsed');
    topbar.classList.toggle('collapsed');
    content.classList.toggle('collapsed');
}

// Active link highlight
document.querySelectorAll('.admin-link').forEach(link => {
    link.addEventListener('click', function() {
        document.querySelectorAll('.admin-link').forEach(l => l.classList.remove('active'));
        this.classList.add('active');
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
