@extends('layouts.app')

@section('title', 'Kelola Kasir')

@push('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, #29b6f6 0%, #039be5 100%);
        border-radius: 20px;
        padding: 30px 40px;
        margin-bottom: 30px;
        color: white;
        box-shadow: 0 5px 20px rgba(41, 182, 246, 0.3);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .page-header h4 {
        margin: 0;
        font-weight: 700;
        font-size: 1.8rem;
    }

    .btn-add {
        background: white;
        color: #039be5;
        border: none;
        padding: 12px 30px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 3px 10px rgba(0,0,0,0.2);
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        color: #ffffffff;
    }

    .kasir-card {
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
        background: linear-gradient(135deg, #e1f5fe, #b3e5fc);
    }

    .table thead th {
        border: none;
        color: #01579b;
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

    .status-badge {
        padding: 8px 18px;
        border-radius: 12px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .status-aktif {
        background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
        color: #2e7d32;
    }

    .status-aktif::before {
        content: '';
        width: 8px;
        height: 8px;
        background: #2e7d32;
        border-radius: 50%;
        animation: pulse 2s infinite;
    }

    .status-nonaktif {
        background: linear-gradient(135deg, #ffebee, #ffcdd2);
        color: #c62828;
    }

    .status-nonaktif::before {
        content: '';
        width: 8px;
        height: 8px;
        background: #c62828;
        border-radius: 50%;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    .date-badge {
        background: linear-gradient(135deg, #f3e5f5, #e1bee7);
        color: #6a1b9a;
        padding: 6px 13px;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
    }

    .btn-edit {
        background: linear-gradient(135deg, #ffa726, #fb8c00);
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s;
        font-size: 0.9rem;
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 167, 38, 0.4);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, #ef5350, #e53935);
        color: white;
        border: none;
        padding: 8px 10px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s;
        font-size: 0.9rem;
    }

    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 83, 80, 0.4);
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
        color: #039be5;
        padding: 10px 18px;
        margin: 0 5px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .pagination .page-link:hover {
        background: linear-gradient(135deg, #e1f5fe, #b3e5fc);
        color: #01579b;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #29b6f6, #039be5);
        color: white;
        box-shadow: 0 3px 10px rgba(41, 182, 246, 0.3);
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }

        .table-container {
            padding: 15px;
            overflow-x: auto;
        }

        .user-info {
            flex-direction: column;
            text-align: center;
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
    <h4><i class="bi bi-people-fill"></i> Daftar Kasir</h4>
    <a href="{{ route('kasir.create') }}" class="btn btn-add">
        <i class="bi bi-person-plus"></i> Tambah Kasir
    </a>
</div>

<div class="kasir-card">
    <div class="table-container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Kasir</th>
                        <th width="150">Username</th>
                        <th width="130">Status</th>
                        <th width="150">Terdaftar</th>
                        <th width="200" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kasirs as $index => $kasir)
                    <tr>
                        <td class="text-center">{{ $kasirs->firstItem() + $index }}</td>
                        <td>
                            <strong style="color: #1a3a2e; font-size: 1rem;">{{ $kasir->nama }}</strong>
                        </td>
                        <td>
                            <code style="background: #f5f5f5; padding: 5px 12px; border-radius: 8px; color: #1a3a2e; font-weight: 600;">
                                {{ $kasir->username }}
                            </code>
                        </td>
                        <td>
                            <span class="status-badge {{ $kasir->status == 'aktif' ? 'status-aktif' : 'status-nonaktif' }}">
                                {{ ucfirst($kasir->status) }}
                            </span>
                        </td>
                        <td>
                            <span class="date-badge">
                                <i class="bi bi-calendar-check"></i> {{ $kasir->created_at->format('d M Y') }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('kasir.edit', $kasir->id) }}" class="btn btn-edit btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('kasir.destroy', $kasir->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete btn-sm" 
                                        onclick="return confirm('Yakin ingin menghapus kasir ini?')">
                                    <i class="bi bi-trash3"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="bi bi-person-x"></i>
                                <h5>Belum ada data kasir</h5>
                                <p class="text-muted">Tambahkan kasir pertama Anda sekarang</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($kasirs->hasPages())
        <div class="d-flex justify-content-center">
            {{ $kasirs->links() }}
        </div>
        @endif
    </div>
</div>
@endsection