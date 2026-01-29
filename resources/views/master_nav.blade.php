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
        :root {
            --primary: #059669; 
            --dark: #0f172a; 
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; display: flex; flex-direction: column; min-height: 100vh; background-color: white; }
        
        /* Navbar */
        .master-nav { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(0,0,0,0.05); padding: 12px 0; z-index: 1030; transition: all 0.3s ease; }
        .navbar-brand { font-weight: 800; font-size: 1.5rem; color: var(--primary) !important; letter-spacing: -0.5px; }
        .nav-link-custom { font-weight: 600; color: var(--dark); text-decoration: none; margin-right: 20px; transition: 0.3s; font-size: 0.95rem; }
        .nav-link-custom:hover { color: var(--primary); }

        /* Search */
        .search-wrapper { position: relative; width: 100%; max-width: 400px; }
        .search-icon { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #94a3b8; }
        .search-input { padding-left: 45px; border-radius: 50px; border: 2px solid #f1f5f9; background: #f1f5f9; transition: 0.3s; }
        .search-input:focus { background: white; border-color: var(--primary); outline: none; }

        /* Hamburger Animation */
        .navbar-toggler {
            border: none; padding: 0; width: 30px; height: 24px; position: relative;
            outline: none !important; box-shadow: none !important; display: flex; flex-direction: column; justify-content: space-between;
        }
        .navbar-toggler span {
            display: block; width: 100%; height: 3px; background-color: var(--dark); border-radius: 4px;
            transition: all 0.4s cubic-bezier(0.68, -0.6, 0.32, 1.6); transform-origin: center;
        }
        .navbar-toggler.open span:nth-of-type(1) { transform: translateY(10px) rotate(45deg); background-color: var(--primary); }
        .navbar-toggler.open span:nth-of-type(2) { opacity: 0; transform: scale(0); }
        .navbar-toggler.open span:nth-of-type(3) { transform: translateY(-11px) rotate(-45deg); background-color: var(--primary); }

        .navbar-collapse.collapsing { height: 0; overflow: hidden; transition: height 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important; }

        /* Mobile Styles */
        @media (max-width: 991px) {
            .navbar-collapse.show, .navbar-collapse.collapsing {
                background: white; padding: 20px; border-radius: 20px; margin-top: 15px;
                box-shadow: 0 15px 40px rgba(0,0,0,0.08); border: 1px solid #f1f5f9;
            }
            .search-wrapper { width: 100%; max-width: 100%; margin-bottom: 20px; }
            .d-flex.align-items-center.gap-4 { flex-direction: column; width: 100%; gap: 20px !important; }
            .nav-link-custom { margin-right: 0; margin-bottom: 15px; display: block; text-align: center; width: 100%; padding: 10px; border-radius: 10px; background: #f8fafc; }
            .glass-pill { width: 100%; max-width: 100%; height: 50px; } 
        }

        /* 💊 GLASS PILL STYLES */
        .glass-pill {
            display: flex; align-items: stretch; width: 220px; height: 44px;
            border-radius: 50px; padding: 3px; 
            background: rgba(255, 255, 255, 0.4); backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            position: relative; overflow: hidden;
        }
        /* Changed from button to 'a' tag friendly */
        .pill-btn {
            border: none; flex: 1; width: 50%; font-weight: 700; font-size: 0.85rem; color: white;
            text-transform: uppercase; letter-spacing: 0.5px; cursor: pointer;
            transition: flex 0.4s ease, background 0.3s; position: relative; z-index: 2;
            text-shadow: 0 1px 2px rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: center; 
            white-space: nowrap; text-decoration: none; /* No underline */
        }
        .glass-pill::after {
            content: ''; position: absolute; top: 2px; left: 10px; right: 10px; height: 45%;
            background: linear-gradient(180deg, rgba(255,255,255,0.4) 0%, rgba(255,255,255,0.05) 100%);
            border-radius: 50px; pointer-events: none; z-index: 5;
        }
        .pill-btn.red { background: linear-gradient(135deg, #fca5a5 0%, #ef4444 100%); border-radius: 50px 0 0 50px; border-right: 1px solid rgba(255, 255, 255, 0.3); }
        .pill-btn.blue { background: linear-gradient(135deg, #93c5fd 0%, #3b82f6 100%); border-radius: 0 50px 50px 0; }
        .pill-btn.red:hover { flex: 1.2; filter: brightness(1.05); background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%); color: white; }
        .pill-btn.blue:hover { flex: 1.2; filter: brightness(1.05); background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: white; }

        footer { margin-top: auto; }
    </style>
    @yield('styles')
</head>
<body>

    <nav class="navbar navbar-expand-lg master-nav sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
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
                    <a href="{{ url('/about') }}" class="nav-link-custom">About Us</a>

                    <div class="glass-pill">
                        <a href="{{ route('login') }}" class="pill-btn red">Log In</a>
                        <a href="{{ route('register') }}" class="pill-btn blue">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-dark text-white pt-5 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4"><h4 class="fw-bold text-white mb-3">Medi-Go</h4><p class="text-secondary small">Your trusted partner for 100% genuine medicines.</p></div>
                <div class="col-lg-4"><h6 class="fw-bold mb-3">Subscribe</h6><div class="input-group"><input type="text" class="form-control" placeholder="Email"><button class="btn btn-success"><i class="fas fa-paper-plane"></i></button></div></div>
            </div>
            <hr class="border-secondary"><p class="text-center small text-secondary">&copy; 2024 Medi-Go. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script> 
        AOS.init({ once: true, offset: 80, duration: 800 }); 
        
        // Simple Hamburger Toggle Logic
        document.getElementById('navbarToggler').addEventListener('click', function () {
            this.classList.toggle('open');
        });
    </script>
</body>
</html>