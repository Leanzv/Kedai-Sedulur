<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Kedai Sedulur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: #c2dacaff;
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #2d5a4a 0%, #1a3a2e 100%);
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            overflow-y: auto;
            z-index: 1040;
            transition: transform 0.3s ease;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 25px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.1);
        }

        .sidebar-header h5 {
            color: white;
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .sidebar-header small {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.85rem;
            padding: 4px 12px;
            background: rgba(77, 182, 172, 0.2);
            border-radius: 12px;
            display: inline-block;
        }

        .sidebar-menu {
            padding: 20px 0;
            flex: 1;
        }

        .sidebar a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            padding: 15px 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s;
            border-left: 4px solid transparent;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .sidebar a i {
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }

        .sidebar a:hover {
            background: rgba(77, 182, 172, 0.15);
            color: #4db6ac;
            border-left-color: #4db6ac;
        }

        .sidebar a.active {
            background: rgba(77, 182, 172, 0.25);
            color: #4db6ac;
            border-left-color: #4db6ac;
            font-weight: 600;
        }

        /* Logout Section */
        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.2);
        }

        .user-info {
            color: white;
            margin-bottom: 12px;
            padding: 12px;
            background: rgba(77, 182, 172, 0.1);
            border-radius: 10px;
        }

        .user-info strong {
            display: block;
            font-size: 0.95rem;
            margin-bottom: 3px;
        }

        .user-info small {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.8rem;
        }

        .btn-logout {
            width: 100%;
            background: linear-gradient(135deg, #ef5350, #e53935);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-logout:hover {
            background: linear-gradient(135deg, #e53935, #c62828);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 83, 80, 0.4);
        }

        .main-content {
            margin-left: 260px;
            transition: margin-left 0.3s ease;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .content-wrapper {
            padding: 30px;
        }

        /* Alert */
        .alert {
            border-radius: 12px;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .alert-success {
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            color: #2e7d32;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ffebee, #ffcdd2);
            color: #c62828;
        }

        /* Mobile Styles */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-260px);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.6);
                z-index: 1030;
                backdrop-filter: blur(2px);
            }
            .sidebar-overlay.show {
                display: block;
            }
        }
        
        /* Button sidebar mobile */
        .sidebar-toggle {
            position: fixed;
            top: 20px;
            left: 20px;
            background: linear-gradient(135deg, #4db6ac, #26a69a);
            border: none;
            color: white;
            font-size: 1.3rem;
            cursor: pointer;
            padding: 12px 18px;
            border-radius: 12px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(77, 182, 172, 0.3);
            z-index: 1000;
            display: none;
        }

        .sidebar-toggle:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(77, 182, 172, 0.4);
        }
        
        @media (max-width: 768px) {
            .sidebar-toggle {
                display: block;
            }

            .content-wrapper {
                padding: 80px 20px 30px;
            }
        }

        /* Scrollbar Styling for Sidebar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(0,0,0,0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(77, 182, 172, 0.5);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(77, 182, 172, 0.8);
        }

        /* Horizontal Scrollbar */
        .table-responsive {
            overflow-x: visible !important;
        }

        @media (max-width: 992px) {
            .table-responsive {
                overflow-x: auto !important;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="d-flex">
        <!-- Button buat sidebar di mobile -->
        <button class="sidebar-toggle" onclick="toggleSidebar()">
            <i class="bi bi-list"></i>
        </button>
        <!-- Overlay sidebar mobile -->
        <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>
        
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h5>
                    Kedai Management
                </h5>
            </div>
            
            <div class="sidebar-menu">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
                
                @if(Auth::user()->role == 'admin')
                <a href="{{ route('menu.index') }}" class="{{ request()->is('menu*') ? 'active' : '' }}">
                    <i class="bi bi-cup-hot"></i>
                    <span>Kelola Menu</span>
                </a>
                <a href="{{ route('kasir.index') }}" class="{{ request()->is('kasir*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    <span>Kelola Kasir</span>
                </a>
                <a href="{{ route('laporan.index') }}" class="{{ request()->is('laporan*') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Laporan Penjualan</span>
                </a>
                <a href="{{ route('lokasi.index') }}" class="{{ request()->is('lokasi*') ? 'active' : '' }}">
                    <i class="bi bi-geo-alt"></i>
                    <span>Lokasi</span>
                </a>
                @endif

                <a href="{{ route('transaksi.index') }}" class="{{ request()->is('transaksi') && !request()->is('transaksi/riwayat') ? 'active' : '' }}">
                    <i class="bi bi-cart"></i>
                    <span>Transaksi</span>
                </a>

                <a href="{{ route('transaksi.riwayat') }}" class="{{ request()->is('transaksi/riwayat') || request()->is('transaksi/*') && !request()->is('transaksi') ? 'active' : '' }}">
                    <i class="bi bi-clock-history"></i>
                    <span>Riwayat Transaksi</span>
                </a>
            </div>

            <!-- Logout Section -->
            <div class="sidebar-footer">
                <div class="user-info">
                    <strong><i></i> {{ Auth::user()->nama }}</strong>
                    <small><i class="bi bi-person-circle"></i> {{ ucfirst(Auth::user()->role) }}</small>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 main-content">
            <!-- Content -->
            <div class="content-wrapper">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        }
        
        // Auto tutu sidebar buat di mobile pas diklik
        if (window.innerWidth <= 768) {
            document.querySelectorAll('.sidebar a').forEach(link => {
                link.addEventListener('click', () => {
                    toggleSidebar();
                });
            });
        }
    </script>
    @stack('scripts')
</body>
</html>