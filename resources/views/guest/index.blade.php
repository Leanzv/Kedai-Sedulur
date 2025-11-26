<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $lokasi->nama_cafe ?? 'Café' }} - Menu & Lokasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e0f2f1 0%, #b2dfdb 100%);
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, #2d5a4a 0%, #1a3a2e 100%);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            padding: 15px 0;
        }

        .navbar-brand {
            color: white !important;
            font-weight: 700;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 500;
            margin: 0 5px;
            transition: all 0.3s;
            border-radius: 8px;
            padding: 8px 12px !important;
        }

        .nav-link:hover {
            background: rgba(77, 182, 172, 0.2);
            color: #4db6ac !important;
        }

        .btn-login {
            background: linear-gradient(135deg, #4db6ac, #26a69a);
            color: white;
            border-radius: 10px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s;
            margin-left: 10px;
            border: none;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(77, 182, 172, 0.4);
            color: white;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #4db6ac 0%, #26a69a 100%);
            color: white;
            padding: 80px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: rgba(77, 182, 172, 0.1);
            border-radius: 50%;
            top: -150px;
            right: -150px;
        }

        .hero::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(77, 182, 172, 0.1);
            border-radius: 50%;
            bottom: -100px;
            left: -100px;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            font-weight: 700;
            font-size: 3.5rem;
            margin-bottom: 20px;
            text-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }

        .hero p {
            font-size: 1.3rem;
            opacity: 0.95;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Section */
        section {
            padding: 80px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title h2 {
            color: #2d5a4a;
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .section-title p {
            color: #666;
            font-size: 1.1rem;
        }

        #menu {
            background: rgba(255, 255, 255, 0.5);
        }

        #lokasi {
            background: rgba(255, 255, 255, 0.7);
        }

        /* Category Filter */
        .category-filter {
            text-align: center;
            margin-bottom: 50px;
        }

        .category-badge {
            display: inline-block;
            padding: 12px 30px;
            margin: 8px;
            border-radius: 25px;
            background: white;
            color: #2d5a4a;
            cursor: pointer;
            transition: all 0.3s;
            border: 2px solid #e0e0e0;
            font-weight: 600;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        .category-badge:hover, .category-badge.active {
            background: linear-gradient(135deg, #4db6ac, #26a69a);
            color: white;
            border-color: #4db6ac;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(77, 182, 172, 0.3);
        }

        /* Menu Card */
        .menu-card {
            transition: all 0.3s;
            height: 100%;
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            background: linear-gradient(135deg, #2d5a4a 0%, #1a3a2e 100%);
            color: white;
            position: relative;
            height: 100%;
        }

        .menu-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 150px;
            height: 150px;
            background: rgba(77, 182, 172, 0.1);
            border-radius: 50%;
            transform: translate(50px, -50px);
        }

        .menu-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .menu-card .card-body {
            padding: 25px 20px;
            text-align: center;
        }

        .menu-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #4db6ac, #26a69a);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            box-shadow: 0 5px 15px rgba(77, 182, 172, 0.3);
        }

        .menu-icon i {
            font-size: 2.2rem;
            color: white;
        }

        .card-title {
            font-weight: 700;
            color: white;
            font-size: 1.1rem;
            margin-bottom: 10px;
        }

        .menu-category {
            display: inline-block;
            padding: 5px 14px;
            background: rgba(255, 255, 255, 0.6);
            color: #2d5a4a;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 12px;
            backdrop-filter: blur(10px);
        }

        .card-text {
            color: rgba(255, 255, 255, 0.8) !important;
            line-height: 1.5;
            font-size: 0.85rem;
        }

        .menu-price {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            margin-top: 12px;
        }

        /* Location Card */
        .location-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            height: 100%;
            border-left: 5px solid #4db6ac;
        }

        .location-card h5 {
            color: #2d5a4a;
            font-weight: 700;
            font-size: 1.6rem;
            margin-bottom: 25px;
        }

        .location-card p {
            color: #666;
            line-height: 1.8;
            font-size: 1.05rem;
        }

        .btn-direction {
            background: linear-gradient(135deg, #4db6ac, #26a69a);
            color: white;
            border: none;
            padding: 14px 35px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(77, 182, 172, 0.3);
            text-decoration: none;
            display: inline-block;
        }

        .btn-direction:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(77, 182, 172, 0.4);
            color: white;
        }

        #map {
            height: 450px;
            border-radius: 20px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.15);
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, #2d5a4a 0%, #1a3a2e 100%);
            color: white;
            padding: 40px 0;
            text-align: center;
        }

        .footer a {
            color: #4db6ac;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: #80cbc4;
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .menu-item {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.2rem;
            }
            
            .hero p {
                font-size: 1.1rem;
            }
            
            .section-title h2 {
                font-size: 2rem;
            }
            
            #map {
                height: 300px;
            }

            .menu-icon {
                width: 70px;
                height: 70px;
            }

            .menu-icon i {
                font-size: 2.2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('guest.index') }}">
                <i class="bi bi-cup-hot-fill"></i> {{ $lokasi->nama_cafe ?? 'Café Management' }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#menu"></i> Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#lokasi"></i> Lokasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-login" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <div class="hero-content">
            <div class="container">
                <h1> Selamat Datang</h1>
                <p>{{ $lokasi->deskripsi ?? '' }}</p>
            </div>
        </div>
    </div>

    <!-- Menu Section -->
    <section id="menu">
        <div class="container">
            <div class="section-title">
                <h2>Menu Kami</h2>
                <p>Berbagai pilihan menu spesial untuk Anda</p>
            </div>
            
            <!-- Filter Kategori -->
            <div class="category-filter">
                <span class="category-badge active" onclick="filterMenu('all')">
                    <i class="bi bi-grid"></i> Semua Menu
                </span>
                <span class="category-badge" onclick="filterMenu('Kopi')">
                    <i class="bi bi-cup-hot"></i> Kopi
                </span>
                <span class="category-badge" onclick="filterMenu('Non Kopi')">
                    <i class="bi bi-cup-straw"></i> Non Kopi
                </span>
                <span class="category-badge" onclick="filterMenu('Squash')">
                    <i class="bi bi-droplet"></i> Squash
                </span>
            </div>

            <div class="row" id="menu-container">
                @forelse($menus as $menu)
                <div class="col-lg-4 col-md-6 mb-4 menu-item" data-category="{{ $menu->kategori }}">
                    <div class="card menu-card">
                        <div class="card-body">
                            <div class="menu-icon">
                                @if($menu->kategori == 'Kopi')
                                    <i class="bi bi-cup-hot"></i>
                                @elseif($menu->kategori == 'Non Kopi')
                                    <i class="bi bi-cup-straw"></i>
                                @elseif($menu->kategori == 'Squash')
                                    <i class="bi bi-droplet"></i>
                                @else
                                    <i class="bi bi-cup"></i>
                                @endif
                            </div>
                            <h5 class="card-title">{{ $menu->nama_menu }}</h5>
                            <span class="menu-category">{{ $menu->kategori }}</span>
                            <p class="card-text text-muted">{{ $menu->deskripsi ?? '' }}</p>
                            <div class="menu-price">Rp {{ number_format($menu->harga, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="bi bi-info-circle"></i> Menu belum tersedia
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Lokasi Section -->
    @if($lokasi)
    <section id="lokasi" style="background: white;">
        <div class="container">
            <div class="section-title">
                <h2>Lokasi Kami</h2>
                <p>Temukan kami di lokasi berikut</p>
            </div>
            
            <div class="row align-items-center">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <div class="location-card">
                        <h5><i class="bi bi-geo-alt-fill text-danger"></i> {{ $lokasi->nama_cafe }}</h5>
                        <p><strong>Alamat:</strong><br>{{ $lokasi->alamat }}</p>
                        <hr class="my-4">
                        <a href="https://www.google.com/maps/dir/?api=1&destination={{ $lokasi->latitude }},{{ $lokasi->longitude }}" 
                           target="_blank" class="btn btn-direction">
                            <i class="bi bi-geo-alt-fill"></i> Google Maps
                        </a>
                        <p class="text-muted mt-3 mb-0">
                            <small><i class="bi bi-pin-map"></i> {{ $lokasi->latitude }}, {{ $lokasi->longitude }}</small>
                        </p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p class="mb-2">&copy;{{ date('Y') }} {{ $lokasi->nama_cafe ?? 'Café Management' }}. All rights reserved.</p>
            <p class="mb-0">
                <a href="{{ route('login') }}">
                    <i class="bi bi-shield-lock"></i> Admin & Staff
                </a>
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <script>
    // Filter Menu - FIX: Hapus delay, langsung hide dulu baru show
    function filterMenu(category) {
        const items = document.querySelectorAll('.menu-item');
        const badges = document.querySelectorAll('.category-badge');
        
        // Update active badge
        badges.forEach(badge => badge.classList.remove('active'));
        event.target.classList.add('active');
        
        // Hide all items immediately first
        items.forEach(item => {
            item.style.display = 'none';
        });
        
        // Then show only matching items with animation
        items.forEach((item, index) => {
            if (category === 'all' || item.dataset.category === category) {
                setTimeout(() => {
                    item.style.display = 'block';
                    item.style.animation = 'fadeInUp 0.4s ease-out';
                }, index); 
            }
        });
    }

    @if($lokasi)
    // Initialize map
    var map = L.map('map').setView([{{ $lokasi->latitude }}, {{ $lokasi->longitude }}], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var cafeIcon = L.icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    var marker = L.marker([{{ $lokasi->latitude }}, {{ $lokasi->longitude }}], {
        icon: cafeIcon
    }).addTo(map);

    marker.bindPopup(`
        <div style="text-align: center;">
            <strong style="color: #2d5a4a;">{{ $lokasi->nama_cafe }}</strong><br>
            <small>{{ $lokasi->alamat }}</small>
        </div>
    `).openPopup();
    @endif

    // Smooth scroll - FIX: Tambah offset untuk navbar sticky
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const target = document.querySelector(targetId);
            
            if (target) {
                const navbarHeight = document.querySelector('.navbar').offsetHeight;
                const targetPosition = target.offsetTop - navbarHeight; // padding buat passin scroll
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
</script>
</body>
</html>