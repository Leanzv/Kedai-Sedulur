@extends('layouts.app')

@section('title', 'Laporan Penjualan')

@push('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, #ff6f00 0%, #e65100 100%);
        border-radius: 20px;
        padding: 30px 40px;
        margin-bottom: 30px;
        color: white;
        box-shadow: 0 5px 20px rgba(255, 111, 0, 0.3);
    }

    .page-header h4 {
        margin: 0;
        font-weight: 700;
        font-size: 1.8rem;
    }

    /* Filter Card */
    .filter-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 25px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    }

    .form-label {
        color: #2d5a4a;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .form-select {
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        padding: 12px 18px;
        font-weight: 600;
        transition: all 0.3s;
        background: #f8f9fa;
    }

    .form-select:focus {
        border-color: #ff6f00;
        background: white;
        box-shadow: 0 0 0 0.2rem rgba(255, 111, 0, 0.1);
    }

    .btn-show {
        background: linear-gradient(135deg, #ff6f00, #e65100);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(255, 111, 0, 0.3);
    }

    .btn-show:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 111, 0, 0.4);
        color: white;
    }

    .btn-export {
        background: linear-gradient(135deg, #ef5350, #e53935);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(239, 83, 80, 0.3);
        text-decoration: none;
        display: inline-block;
    }

    .btn-export:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(239, 83, 80, 0.4);
        color: white;
    }

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: all 0.3s;
        border-left: 5px solid;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    }

    .stat-card-1 { border-left-color: #ff6f00; }
    .stat-card-2 { border-left-color: #66bb6a; }
    .stat-card-3 { border-left-color: #29b6f6; }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-bottom: 15px;
    }

    .stat-icon-1 { background: linear-gradient(135deg, #fff3e0, #ffe0b2); color: #e65100; }
    .stat-icon-2 { background: linear-gradient(135deg, #e8f5e9, #c8e6c9); color: #43a047; }
    .stat-icon-3 { background: linear-gradient(135deg, #e1f5fe, #b3e5fc); color: #039be5; }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #1a3a2e;
        margin-bottom: 5px;
    }

    .stat-label {
        color: #666;
        font-size: 0.95rem;
        font-weight: 500;
    }

    /* Content Cards */
    .content-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 25px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    }

    .card-title {
        font-weight: 700;
        color: #2d5a4a;
        font-size: 1.3rem;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 3px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-title i {
        color: #ff6f00;
    }

    /* Table Style */
    .table {
        margin: 0;
    }

    .table thead {
        background: linear-gradient(135deg, #fff3e0, #ffe0b2);
    }

    .table thead th {
        border: none;
        color: #e65100;
        font-weight: 700;
        padding: 15px;
        font-size: 0.9rem;
    }

    .table tbody tr {
        transition: all 0.3s;
        border-bottom: 1px solid #f0f0f0;
    }

    .table tbody tr:hover {
        background: #f8f9fa;
    }

    .table tbody td {
        padding: 18px 15px;
        vertical-align: middle;
        color: #2d5a4a;
    }

    /* Rank Badges */
    .rank-badge {
        font-size: 1.5rem;
        display: inline-block;
    }

    /* Progress Bar */
    .progress {
        height: 25px;
        border-radius: 12px;
        background: #f0f0f0;
        overflow: hidden;
    }

    .progress-bar {
        background: linear-gradient(135deg, #ff6f00, #e65100);
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: width 0.6s ease;
    }

    .table-responsive {
        overflow-x: visible !important;
    }

    @media (max-width: 992px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .filter-card {
            padding: 20px;
        }

        .table-responsive {
            overflow-x: auto !important;
        }
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <h4><i class="bi bi-graph-up-arrow"></i> Laporan Penjualan</h4>
</div>

<!-- Filter -->
<div class="filter-card">
    <form action="{{ route('laporan.index') }}" method="GET" class="row g-3 align-items-end">
        <div class="col-md-3">
            <label class="form-label">Bulan</label>
            <select name="bulan" class="form-select">
                <option value="01" {{ $bulan == '01' ? 'selected' : '' }}>Januari</option>
                <option value="02" {{ $bulan == '02' ? 'selected' : '' }}>Februari</option>
                <option value="03" {{ $bulan == '03' ? 'selected' : '' }}>Maret</option>
                <option value="04" {{ $bulan == '04' ? 'selected' : '' }}>April</option>
                <option value="05" {{ $bulan == '05' ? 'selected' : '' }}>Mei</option>
                <option value="06" {{ $bulan == '06' ? 'selected' : '' }}>Juni</option>
                <option value="07" {{ $bulan == '07' ? 'selected' : '' }}>Juli</option>
                <option value="08" {{ $bulan == '08' ? 'selected' : '' }}>Agustus</option>
                <option value="09" {{ $bulan == '09' ? 'selected' : '' }}>September</option>
                <option value="10" {{ $bulan == '10' ? 'selected' : '' }}>Oktober</option>
                <option value="11" {{ $bulan == '11' ? 'selected' : '' }}>November</option>
                <option value="12" {{ $bulan == '12' ? 'selected' : '' }}>Desember</option>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Tahun</label>
            <select name="tahun" class="form-select">
                @for($i = date('Y'); $i >= 2020; $i--)
                <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="col-md-6">
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-show">
                    <i class="bi bi-search"></i> Tampilkan
                </button>
                <a href="{{ route('laporan.pdf', ['bulan' => $bulan, 'tahun' => $tahun]) }}" 
                   class="btn btn-export" target="_blank">
                    <i class="bi bi-file-pdf"></i> Export PDF
                </a>
            </div>
        </div>
    </form>
</div>

<!-- Stats -->
<div class="stats-grid">
    <div class="stat-card stat-card-1">
        <div class="stat-icon stat-icon-1">
            <i class="bi bi-receipt"></i>
        </div>
        <div class="stat-value">{{ $laporan['total_transaksi'] }}</div>
        <div class="stat-label">Total Transaksi</div>
    </div>

    <div class="stat-card stat-card-2">
        <div class="stat-icon stat-icon-2">
            <i class="bi bi-cash-stack"></i>
        </div>
        <div class="stat-value">Rp {{ number_format($laporan['total_pendapatan'], 0, ',', '.') }}</div>
        <div class="stat-label">Total Pendapatan</div>
    </div>

    <div class="stat-card stat-card-3">
        <div class="stat-icon stat-icon-3">
            <i class="bi bi-calculator"></i>
        </div>
        <div class="stat-value">Rp {{ $laporan['total_transaksi'] > 0 ? number_format($laporan['total_pendapatan'] / $laporan['total_transaksi'], 0, ',', '.') : 0 }}</div>
        <div class="stat-label">Rata-rata per Transaksi</div>
    </div>
</div>

<!-- Top Products -->
<div class="content-card">
    <h6 class="card-title"><i class="bi bi-trophy-fill"></i> Top 5 Produk Terlaris</h6>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th width="80">Peringkat</th>
                    <th>Nama Menu</th>
                    <th width="150">Kategori</th>
                    <th width="150">Total Terjual</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporan['produk_terlaris'] as $index => $produk)
                <tr>
                    <td class="text-center">
                        @if($index == 0)
                            <span class="rank-badge">🥇</span>
                        @elseif($index == 1)
                            <span class="rank-badge">🥈</span>
                        @elseif($index == 2)
                            <span class="rank-badge">🥉</span>
                        @else
                            <strong style="font-size: 1.2rem; color: #666;">{{ $index + 1 }}</strong>
                        @endif
                    </td>
                    <td><strong style="color: #1a3a2e;">{{ $produk->menu->nama_menu }}</strong></td>
                    <td>
                        <span style="background: linear-gradient(135deg, #e0f2f1, #b2dfdb); color: #2d5a4a; padding: 6px 14px; border-radius: 10px; font-weight: 600; font-size: 0.85rem;">
                            {{ $produk->menu->kategori }}
                        </span>
                    </td>
                    <td><strong style="color: #ff6f00; font-size: 1.05rem;">{{ $produk->total_terjual }} porsi</strong></td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center" style="padding: 40px;">
                        <i class="bi bi-inbox" style="font-size: 3rem; color: #ddd; display: block; margin-bottom: 10px;"></i>
                        <span style="color: #999;">Belum ada data</span>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Payment Methods -->
<div class="content-card">
    <h6 class="card-title"><i class="bi bi-credit-card-fill"></i> Metode Pembayaran</h6>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Metode</th>
                    <th width="150">Jumlah</th>
                    <th width="300">Persentase</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laporan['metode_pembayaran'] as $metode)
                <tr>
                    <td>
                        <span style="padding: 8px 16px; border-radius: 12px; font-weight: 600; font-size: 0.9rem; display: inline-block;
                            @if($metode->metode_pembayaran == 'tunai')
                                background: linear-gradient(135deg, #e8f5e9, #c8e6c9); color: #2e7d32;
                            @else
                                background: linear-gradient(135deg, #fff3e0, #ffe0b2); color: #e65100;
                            @endif
                        ">
                            @if($metode->metode_pembayaran == 'tunai')
                                Tunai
                            @else
                                QRIS
                            @endif
                        </span>
                    </td>
                    <td><strong style="color: #1a3a2e;">{{ $metode->jumlah }} transaksi</strong></td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar" style="width: {{ $laporan['total_transaksi'] > 0 ? ($metode->jumlah / $laporan['total_transaksi'] * 100) : 0 }}%">
                                {{ $laporan['total_transaksi'] > 0 ? number_format($metode->jumlah / $laporan['total_transaksi'] * 100, 1) : 0 }}%
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Daily Transaction -->
<div class="content-card">
    <h6 class="card-title"><i class="bi bi-calendar3"></i> Transaksi Per Hari</h6>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th width="180">Jumlah Transaksi</th>
                    <th width="200">Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporan['transaksi_per_hari'] as $data)
                <tr>
                    <td><strong style="color: #1a3a2e;">{{ \Carbon\Carbon::parse($data->tanggal)->format('d M Y') }}</strong></td>
                    <td>{{ $data->jumlah }} transaksi</td>
                    <td><strong style="color: #ff6f00; font-size: 1.05rem;">Rp {{ number_format($data->pendapatan, 0, ',', '.') }}</strong></td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center" style="padding: 40px;">
                        <i class="bi bi-inbox" style="font-size: 3rem; color: #ddd; display: block; margin-bottom: 10px;"></i>
                        <span style="color: #999;">Belum ada data</span>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection