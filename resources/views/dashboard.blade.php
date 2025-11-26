@extends('layouts.app')

@section('title', 'Dashboard')

@push('styles')
<style>
    /* Dashboard Container */
    .dashboard-container {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Welcome Section */
    .welcome-banner {
        background: linear-gradient(135deg, #4db6ac 0%, #26a69a 100%);
        border-radius: 25px;
        padding: 50px 40px;
        margin-bottom: 30px;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(77, 182, 172, 0.3);
    }

    .welcome-banner::before {
        content: '';
        position: absolute;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: -150px;
        right: -100px;
    }

    .welcome-banner::after {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        bottom: -100px;
        left: -80px;
    }

    .welcome-content {
        position: relative;
        z-index: 1;
    }

    .welcome-content h2 {
        font-weight: 700;
        font-size: 2.5rem;
        margin-bottom: 15px;
        text-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .welcome-content p {
        font-size: 1.1rem;
        opacity: 0.95;
        margin-bottom: 20px;
    }

    .role-badge {
        background: rgba(255, 255, 255, 0.25);
        padding: 8px 25px;
        border-radius: 25px;
        display: inline-block;
        font-size: 1rem;
        font-weight: 600;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }

    .stat-box {
        background: linear-gradient(135deg, #2d5a4a 0%, #1a3a2e 100%);
        border-radius: 20px;
        padding: 35px;
        position: relative;
        overflow: hidden;
        transition: all 0.3s;
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        color: white;
    }

    .stat-box::before {
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

    .stat-box:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(77, 182, 172, 0.3);
    }

    .stat-box:hover .stat-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .stat-icon {
        width: 70px;
        height: 70px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin-bottom: 25px;
        position: relative;
        z-index: 1;
        transition: transform 0.3s;
    }

    .icon-1 { background: linear-gradient(135deg, #4db6ac, #26a69a); }
    .icon-2 { background: linear-gradient(135deg, #66bb6a, #43a047); }
    .icon-3 { background: linear-gradient(135deg, #ffa726, #fb8c00); }
    .icon-4 { background: linear-gradient(135deg, #29b6f6, #039be5); }

    .stat-value {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 8px;
        position: relative;
        z-index: 1;
    }

    .stat-label {
        font-size: 1.1rem;
        font-weight: 500;
        opacity: 0.9;
        position: relative;
        z-index: 1;
    }

    .stat-sublabel {
        font-size: 0.9rem;
        margin-top: 8px;
        opacity: 0.7;
        position: relative;
        z-index: 1;
    }

    /* Info Section */
    .info-section {
        background: linear-gradient(135deg, #e0f2f1, #b2dfdb);
        border-radius: 20px;
        padding: 35px;
        border-left: 6px solid #4db6ac;
        box-shadow: 0 5px 20px rgba(77, 182, 172, 0.15);
    }

    .info-section h5 {
        color: #2d5a4a;
        font-weight: 700;
        font-size: 1.3rem;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info-section p {
        color: #1a3a2e;
        line-height: 1.8;
        margin: 0;
    }

    /* Button Kasir */
    .kasir-section {
        background: linear-gradient(135deg, #2d5a4a 0%, #1a3a2e 100%);
        border-radius: 20px;
        padding: 50px;
        text-align: center;
        color: white;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        position: relative;
        overflow: hidden;
    }

    .kasir-section::before {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: rgba(77, 182, 172, 0.1);
        border-radius: 50%;
        top: -100px;
        right: -100px;
    }

    .kasir-section-content {
        position: relative;
        z-index: 1;
    }

    .kasir-icon {
        width: 100px;
        height: 100px;
        background: rgba(77, 182, 172, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        backdrop-filter: blur(10px);
    }

    .kasir-icon i {
        font-size: 3rem;
        color: #4db6ac;
    }

    .kasir-section h4 {
        font-weight: 700;
        font-size: 2rem;
        margin-bottom: 15px;
    }

    .kasir-section p {
        opacity: 0.9;
        font-size: 1.1rem;
        margin-bottom: 30px;
    }

    .btn-kasir-start {
        background: linear-gradient(135deg, #4db6ac, #26a69a);
        color: white;
        border: none;
        border-radius: 15px;
        padding: 18px 50px;
        font-size: 1.2rem;
        font-weight: 700;
        transition: all 0.3s;
        box-shadow: 0 5px 20px rgba(77, 182, 172, 0.4);
        text-decoration: none;
        display: inline-block;
    }

    .btn-kasir-start:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(77, 182, 172, 0.5);
        color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .welcome-banner {
            padding: 30px 25px;
        }
        
        .welcome-content h2 {
            font-size: 1.8rem;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .stat-value {
            font-size: 2.5rem;
        }
    }
</style>
@endpush

@section('content')
<div class="dashboard-container">
    <!-- Welcome Banner -->
    <div class="welcome-banner">
        <div class="welcome-content">
            <h2>
                Selamat Datang, {{ Auth::user()->nama }}!
            </h2>
            <p>Sistem Manajemen Kedai Sedulur - Dashboard Overview</p>
            <span class="role-badge">
                @if(Auth::user()->role == 'admin')
                    <i class="bi bi-shield-check"></i> Admin
                @else
                    <i class="bi bi-person-badge"></i> Kasir
                @endif
            </span>
        </div>
    </div>

    <!-- Statistics -->
    <div class="stats-grid">
        <div class="stat-box">
            <div class="stat-icon icon-1">
                <i class="bi bi-cup-hot-fill"></i>
            </div>
            <div class="stat-value">{{ $totalMenu }}</div>
            <div class="stat-label">Total Menu</div>
            <div class="stat-sublabel">Menu tersedia di sistem</div>
        </div>

        <div class="stat-box">
            <div class="stat-icon icon-2">
                <i class="bi bi-receipt"></i>
            </div>
            <div class="stat-value">{{ $totalTransaksi }}</div>
            <div class="stat-label">Total Transaksi</div>
            <div class="stat-sublabel">Transaksi selesai</div>
        </div>

        <div class="stat-box">
            <div class="stat-icon icon-3">
                <i class="bi bi-cash-stack"></i>
            </div>
            <div class="stat-value">
                @if($totalPendapatan >= 1000000)
                    {{ number_format($totalPendapatan / 1000000, 1) }}M
                @else
                    {{ number_format($totalPendapatan / 1000, 0) }}K
                @endif
            </div>
            <div class="stat-label">Total Pendapatan</div>
            <div class="stat-sublabel">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
        </div>

        @if(Auth::user()->role == 'admin')
        <div class="stat-box">
            <div class="stat-icon icon-4">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-value">{{ $totalKasir }}</div>
            <div class="stat-label">Total Kasir</div>
            <div class="stat-sublabel">Staff aktif</div>
        </div>
        @endif
    </div>

    <!-- Info Section or Kasir Action -->
    @if(Auth::user()->role == 'admin')
    <div class="info-section">
        <h5>
            <i class="bi bi-info-circle-fill"></i>
            Informasi Sistem
        </h5>
        <p>
            <strong>Selamat bekerja!</strong> Gunakan menu navigasi di sebelah kiri untuk mengelola kedai. 
            Anda dapat mengelola menu, kasir, melihat laporan penjualan, dan mengatur lokasi kedai.
            Pastikan untuk selalu memperbarui data menu dan memantau kinerja kasir secara berkala.
        </p>
    </div>
    @else
    <div class="kasir-section">
        <div class="kasir-section-content">
            <div class="kasir-icon">
                <i class="bi bi-cart-check-fill"></i>
            </div>
            <h4>Siap Melayani Pelanggan</h4>
            <p>Mulai transaksi baru dan catat pesanan dengan cepat</p> 
        </div>
    </div>
    @endif
</div>
@endsection