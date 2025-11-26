@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@push('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, #9c27b0 0%, #7b1fa2 100%);
        border-radius: 20px;
        padding: 30px 40px;
        margin-bottom: 30px;
        color: white;
        box-shadow: 0 5px 20px rgba(156, 39, 176, 0.3);
    }

    .page-header h4 {
        margin: 0;
        font-weight: 700;
        font-size: 1.8rem;
    }

    .transaksi-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        border: none;
    }

    .table-container {
        padding: 30px;
    }

    .table {
        margin: 0;
    }

    .table thead {
        background: linear-gradient(135deg, #f3e5f5, #e1bee7);
    }

    .table thead th {
        border: none;
        color: #4a148c;
        font-weight: 700;
        padding: 18px 15px;
        font-size: 0.95rem;
    }

    .table tbody tr {
        transition: all 0.3s;
        border-bottom: 1px solid #f0f0f0;
    }

    .table tbody tr:hover {
        background: #f8f9fa;
        transform: scale(1.01);
    }

    .table tbody td {
        padding: 20px 15px;
        vertical-align: middle;
        color: #2d5a4a;
    }

    .kode-badge {
        background: linear-gradient(135deg, #f3e5f5, #e1bee7);
        color: #4a148c;
        padding: 8px 16px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.9rem;
        display: inline-block;
    }

    .date-text {
        color: #666;
        font-size: 0.9rem;
    }

    .date-text i {
        color: #9c27b0;
    }

    .kasir-badge {
        background: linear-gradient(135deg, #e3f2fd, #bbdefb);
        color: #1565c0;
        padding: 6px 14px;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .price-text {
        font-weight: 700;
        color: #9c27b0;
        font-size: 1.1rem;
    }

    .payment-badge {
        padding: 8px 16px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-block;
    }

    .payment-tunai {
        background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
        color: #2e7d32;
    }

    .payment-transfer {
        background: linear-gradient(135deg, #e3f2fd, #bbdefb);
        color: #1565c0;
    }

    .payment-qris {
        background: linear-gradient(135deg, #fff3e0, #ffe0b2);
        color: #e65100;
    }

    .btn-detail {
        background: linear-gradient(135deg, #29b6f6, #039be5);
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s;
        font-size: 0.9rem;
        text-decoration: none;
        display: inline-block;
    }

    .btn-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(41, 182, 246, 0.4);
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #999;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 20px;
        color: #ddd;
    }

    .pagination {
        margin-top: 25px;
    }

    .pagination .page-link {
        border: none;
        color: #9c27b0;
        padding: 10px 18px;
        margin: 0 5px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .pagination .page-link:hover {
        background: linear-gradient(135deg, #f3e5f5, #e1bee7);
        color: #4a148c;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #9c27b0, #7b1fa2);
        color: white;
        box-shadow: 0 3px 10px rgba(156, 39, 176, 0.3);
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 25px;
        }

        .table-container {
            padding: 15px;
            overflow-x: auto;
        }
    }

    .table-responsive {
        overflow-x: visible !important;
    }

    @media (max-width: 992px) {
        .table-responsive {
            overflow-x: auto !important;
        }
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <h4><i class="bi bi-clock-history"></i> Riwayat Transaksi</h4>
</div>

<div class="transaksi-card">
    <div class="table-container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Kode Transaksi</th>
                        <th width="180">Tanggal</th>
                        @if(Auth::user()->role == 'admin')
                        <th width="150">Kasir</th>
                        @endif
                        <th width="150">Total Harga</th>
                        <th width="130">Pembayaran</th>
                        <th width="120" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $index => $transaksi)
                    <tr>
                        <td class="text-center">{{ $transaksis->firstItem() + $index }}</td>
                        <td>
                            <span class="kode-badge">{{ $transaksi->kode_transaksi }}</span>
                        </td>
                        <td>
                            <div class="date-text">
                                <i class="bi bi-calendar3"></i> {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y H:i') }}
                            </div>
                        </td>
                        @if(Auth::user()->role == 'admin')
                        <td>
                            <span class="kasir-badge">
                                <i class="bi bi-person"></i>
                                {{ $transaksi->user->nama }}
                            </span>
                        </td>
                        @endif
                        <td>
                            <div class="price-text">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</div>
                        </td>
                        <td>
                            <span class="payment-badge 
                                @if($transaksi->metode_pembayaran == 'tunai') payment-tunai
                                @else payment-qris
                                @endif">
                                @if($transaksi->metode_pembayaran == 'tunai')
                                    Cash
                                @else
                                    QRIS
                                @endif
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('transaksi.show', $transaksi->id) }}" class="btn btn-detail">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ Auth::user()->role == 'admin' ? '7' : '6' }}">
                            <div class="empty-state">
                                <i class="bi bi-receipt"></i>
                                <h5>Belum ada transaksi</h5>
                                <p class="text-muted">Transaksi akan muncul di sini</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($transaksis->hasPages())
        <div class="d-flex justify-content-center">
            {{ $transaksis->links() }}
        </div>
        @endif
    </div>
</div>
@endsection