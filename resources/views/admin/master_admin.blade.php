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

        .admin-sidebar.collapsed {
            width: 90px;
        }

        .admin-logo {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 30px;
            white-space: nowrap;
            overflow: hidden;
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
            position: relative;
        }

        .admin-link i {
            width: 22px;
            text-align: center;
        }

        .admin-link:hover {
            background: #ecfdf5;
            color: var(--primary);
            transform: translateX(5px);
        }

        .admin-link.active {
            background: linear-gradient(135deg, #ecfdf5, #d1fae5);
            color: var(--primary);
        }

        .admin-sidebar.collapsed .link-text {
            display: none;
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

        .admin-topbar.collapsed {
            margin-left: 90px;
        }

        .admin-content {
            margin-left: 260px;
            padding: 25px;
            transition: 0.4s;
        }

        .admin-content.collapsed {
            margin-left: 90px;
        }

        .admin-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
        }

        .toggle-btn {
            cursor: pointer;
            font-size: 1.3rem;
            color: var(--dark);
        }

        /* Mobile */
        @media (max-width: 768px) {
            .admin-sidebar {
                left: -260px;
            }
            .admin-sidebar.show {
                left: 0;
            }
            .admin-topbar,
            .admin-content {
                margin-left: 0 !important;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="admin-sidebar" id="sidebar">
    <div class="admin-logo">
        <i class="fas fa-plus-circle"></i>
        <span class="link-text"> MediSwift</span>
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
        <i class="fas fa-shopping-bag"></i>
        <span class="link-text">Orders</span>
    </a>

    <a href="#" class="admin-link">
        <i class="fas fa-layer-group"></i>
        <span class="link-text">Categories</span>
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
        <span class="fw-bold">Admin</span>
        <div class="admin-avatar">A</div>
    </div>
</div>

<!-- Content -->
<div class="admin-content" id="content">
    @yield('content')
</div>

<script>
function toggleSidebar() {
    let sidebar = document.getElementById('sidebar');
    let topbar = document.getElementById('topbar');
    let content = document.getElementById('content');

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

</body>
</html>
