<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kedai Sedulur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #2d5a4a 0%, #1a3a2e 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Login Card */
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            max-width: 1000px;
            width: 100%;
        }

        /* Panel Kiri*/
        .left-panel {
            background: linear-gradient(135deg, #2d5a4a 0%, #1a3a2e 100%);
            padding: 50px 40px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 660px;
        }

        .brand-section {
            margin-bottom: 40px;
        }

        .brand-icon {
            font-size: 3.5rem;
            margin-bottom: 20px;
            color: #4db6ac;
        }

        .brand-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 12px;
            line-height: 1.2;
        }

        .brand-subtitle {
            padding-top: 5px;
            font-size: 1rem;
            opacity: 0.9;
            line-height: 1.5;
        }

        .features-section {
            margin-top: 30px;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 18px;
        }

        .feature-icon {
            background: rgba(77, 182, 172, 0.2);
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: #4db6ac;
            flex-shrink: 0;
        }

        .feature-text h6 {
            font-weight: 600;
            margin-bottom: 4px;
            font-size: 0.95rem;
        }

        .feature-text p {
            margin: 0;
            opacity: 0.8;
            font-size: 0.85rem;
        }

        /* Panel Kanan*/
        .right-panel {
            padding: 50px 45px;
            background: white;
        }

        .form-header {
            margin-bottom: 40px;
        }

        .form-header h2 {
            padding-top: 50px;
            color: #2d5a4a;
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .form-header p {
            color: #666;
            font-size: 1rem;
        }

        .form-label {
            color: #2d5a4a;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 0.95rem;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 14px 18px;
            font-size: 1rem;
            transition: all 0.3s;
            background: #f8f9fa;
        }

        .form-control:focus {
            border-color: #4db6ac;
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(77, 182, 172, 0.1);
        }

        .btn-login {
            background: linear-gradient(135deg, #4db6ac, #26a69a);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1rem;
            width: 100%;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(77, 182, 172, 0.3);
            margin-top: 10px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(77, 182, 172, 0.4);
            color: white;
        }

        .info-box {
            background: linear-gradient(135deg, #e0f2f1, #b2dfdb);
            border: none;
            border-left: 4px solid #4db6ac;
            border-radius: 12px;
            color: #2d5a4a;
            padding: 15px 20px;
            margin-top: 20px;
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            color: #999;
            font-size: 0.9rem;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: #4db6ac;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 600;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: #26a69a;
        }

        .alert {
            border-radius: 12px;
            border: none;
        }

        /* Responsif */
        @media (max-width: 768px) {
            .left-panel {
                display: none;
            }
            
            .right-panel {
                padding: 40px 30px;
            }
            
            .form-header h2 {
                font-size: 1.6rem;
            }
        }
    </style>
</head>
<body>
    <!-- Login Card -->
    <div class="login-card">
        <div class="row g-0">
            <!-- Panel Kiri -->
            <div class="col-lg-6">
                <div class="left-panel">
                    <div class="brand-section">
                        <h1 class="brand-title">Kedai Sedulur <br> Management System</h1>
                        <p class="brand-subtitle">
                            Sistem manajemen kedai modern untuk mengelola menu, transaksi, dan laporan penjualan dengan mudah dan cepat.
                        </p>
                    </div>

                    <div class="features-section">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-speedometer2"></i>
                            </div>
                            <div class="feature-text">
                                <h6>Dashboard Realtime</h6>
                                <p>Pantau performa bisnis secara langsung</p>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-cart-check"></i>
                            </div>
                            <div class="feature-text">
                                <h6>Transaksi Cepat</h6>
                                <p>Proses pesanan dengan efisien</p>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-graph-up"></i>
                            </div>
                            <div class="feature-text">
                                <h6>Laporan Lengkap</h6>
                                <p>Analisis penjualan dan export PDF</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel Kanan -->
            <div class="col-lg-6">
                <div class="right-panel">
                    <div class="form-header">
                        <h2>Selamat Datang!</h2>
                        <p>Masuk untuk mengakses sistem Kedai Sedulur</p>
                    </div>

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" 
                                   placeholder="Masukkan username" value="{{ old('username') }}" required autofocus>
                            @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                   placeholder="Masukkan password" required>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn-login">
                            <i class="bi bi-box-arrow-in-right"></i> Login Sekarang
                        </button>
                    </form>

                    <div class="text-center">
                        <div class="divider">atau</div>
                        <a href="{{ route('guest.index') }}" class="back-link">
                            <i class="bi bi-arrow-left"></i> Kembali ke Halaman Utama
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>