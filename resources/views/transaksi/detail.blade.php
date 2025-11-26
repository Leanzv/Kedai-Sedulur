@extends('layouts.app')

@section('title', 'Detail Transaksi')

@push('styles')
<style>
    .detail-container {
        max-width: 1100px;
        margin: 0 auto;
    }

    .page-header {
        background: linear-gradient(135deg, #9c27b0 0%, #7b1fa2 100%);
        border-radius: 20px;
        padding: 25px 35px;
        margin-bottom: 25px;
        color: white;
        box-shadow: 0 5px 20px rgba(156, 39, 176, 0.3);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .page-header h5 {
        margin: 0;
        font-weight: 700;
        font-size: 1.6rem;
    }

    .btn-print {
        background: white;
        color: #9c27b0;
        border: none;
        padding: 10px 25px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 3px 10px rgba(0,0,0,0.2);
    }

    .btn-print:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        color: #9c27b0;
    }

    /* Info Card */
    .info-card {
        background: white;
        border-radius: 20px;
        padding: 35px;
        margin-bottom: 25px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        padding: 18px 0;
        border-bottom: 2px solid #f0f0f0;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: #666;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-label i {
        color: #9c27b0;
    }

    .info-value {
        font-weight: 700;
        color: #1a3a2e;
        font-size: 1rem;
        text-align: right;
    }

    .kode-badge {
        background: linear-gradient(135deg, #f3e5f5, #e1bee7);
        color: #4a148c;
        padding: 8px 18px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
    }

    .kasir-badge {
        background: linear-gradient(135deg, #e3f2fd, #bbdefb);
        color: #1565c0;
        padding: 6px 16px;
        border-radius: 10px;
        font-weight: 600;
    }

    .payment-badge {
        padding: 8px 18px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.95rem;
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

    .total-highlight {
        background: linear-gradient(135deg, #f3e5f5, #e1bee7);
        color: #4a148c;
        padding: 8px 18px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1.3rem;
    }

    /* Items Card */
    .items-card {
        background: white;
        border-radius: 20px;
        padding: 35px;
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
        color: #9c27b0;
    }

    /* Table */
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
        border-bottom: 1px solid #f0f0f0;
    }

    .table tbody td {
        padding: 20px 15px;
        vertical-align: middle;
        color: #2d5a4a;
    }

    .item-name {
        font-weight: 700;
        color: #1a3a2e;
        font-size: 1rem;
    }

    .qty-badge {
        background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
        color: #2e7d32;
        padding: 5px 12px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.9rem;
    }

    .price-text {
        font-weight: 600;
        color: #666;
    }

    .subtotal-text {
        font-weight: 700;
        color: #9c27b0;
        font-size: 1.05rem;
    }

    .table tfoot {
        background: linear-gradient(135deg, #f3e5f5, #e1bee7);
    }

    .table tfoot th {
        padding: 20px 15px;
        color: #4a148c;
        font-size: 1.1rem;
    }

    .total-final {
        color: #4a148c;
        font-size: 1.3rem;
        font-weight: 700;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 15px;
        justify-content: flex-end;
    }

    .btn-back {
        background: #e0e0e0;
        color: #666;
        border: none;
        padding: 14px 35px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-back:hover {
        background: #d0d0d0;
        transform: translateY(-2px);
        color: #666;
    }

    /* Print Styles */
    @media print {
        .page-header, .action-buttons, .btn-print, .no-print {
            display: none !important;
        }

        .info-card, .items-card {
            box-shadow: none !important;
            page-break-inside: avoid;
        }

        body {
            background: white;
        }
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }

        .info-card, .items-card {
            padding: 25px;
        }

        .info-row {
            flex-direction: column;
            gap: 8px;
        }

        .info-value {
            text-align: left;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-back {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="detail-container">
    <div class="page-header">
        <h5><i class="bi bi-receipt-cutoff"></i> Detail Transaksi</h5>
        <button onclick="window.print()" class="btn btn-print">
            <i class="bi bi-printer"></i> Print
        </button>
    </div>

    <!-- Transaction Info -->
    <div class="info-card">
        <div class="info-row">
            <div class="info-label">
                <i class="bi bi-hash"></i> Kode Transaksi
            </div>
            <div class="info-value">
                <span class="kode-badge">{{ $transaksi->kode_transaksi }}</span>
            </div>
        </div>

        <div class="info-row">
            <div class="info-label">
                <i class="bi bi-calendar-check"></i> Tanggal & Waktu
            </div>
            <div class="info-value">
                {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y H:i') }} WIB
            </div>
        </div>

        <div class="info-row">
            <div class="info-label">
                <i class="bi bi-person-badge"></i> Kasir
            </div>
            <div class="info-value">
                <span class="kasir-badge">
                    <i class="bi bi-person"></i> {{ $transaksi->user->nama }}
                </span>
            </div>
        </div>

        <div class="info-row">
            <div class="info-label">
                <i class="bi bi-wallet2"></i> Metode Pembayaran
            </div>
            <div class="info-value">
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
            </div>
        </div>

        <div class="info-row">
            <div class="info-label">
                <i class="bi bi-cash-stack"></i> Total Pembayaran
            </div>
            <div class="info-value">
                <span class="total-highlight">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <!-- Items Table -->
    <div class="items-card">
        <h6 class="card-title">
            <i class="bi bi-cart-check-fill"></i> Detail Pesanan
        </h6>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Menu</th>
                        <th width="120" class="text-center">Harga</th>
                        <th width="100" class="text-center">Jumlah</th>
                        <th width="150" class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksi->detailTransaksi as $index => $detail)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>
                            <div class="item-name">{{ $detail->menu->nama_menu }}</div>
                        </td>
                        <td class="text-center">
                            <span class="price-text">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</span>
                        </td>
                        <td class="text-center">
                            <span class="qty-badge">{{ $detail->jumlah }}x</span>
                        </td>
                        <td class="text-end">
                            <span class="subtotal-text">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-end">TOTAL PEMBAYARAN</th>
                        <th class="text-end">
                            <span class="total-final">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons no-print">
        <a href="{{ route('transaksi.riwayat') }}" class="btn btn-back">
            <i class="bi bi-arrow-left"></i> Kembali ke Riwayat
        </a>
    </div>
</div>
@endsection