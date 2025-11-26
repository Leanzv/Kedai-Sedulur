@extends('layouts.app')

@section('title', 'Kelola Menu')

@push('styles')


<style>
    .page-header {
        background: linear-gradient(135deg, #4db6ac 0%, #26a69a 100%);
        border-radius: 20px;
        padding: 30px 40px;
        margin-bottom: 30px;
        color: white;
        box-shadow: 0 5px 20px rgba(77, 182, 172, 0.3);
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
        color: #26a69a;
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

    .menu-card {
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
        background: linear-gradient(135deg, #e0f2f1, #b2dfdb);
    }

    .table thead th {
        border: none;
        color: #1a3a2e;
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

    .badge-category {
        padding: 8px 16px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .badge-kopi {
        background: linear-gradient(135deg, #8d6e63, #6d4c41);
        color: white;
    }

    .badge-non-kopi {
        background: linear-gradient(135deg, #66bb6a, #43a047);
        color: white;
    }

    .badge-squash {
        background: linear-gradient(135deg, #29b6f6, #039be5);
        color: white;
    }

    .status-badge {
        padding: 6px 14px;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .status-tersedia {
        background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
        color: #2e7d32;
    }

    .status-habis {
        background: linear-gradient(135deg, #ffebee, #ffcdd2);
        color: #c62828;
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
        color: #2d5a4a;
        padding: 10px 18px;
        margin: 0 5px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .pagination .page-link:hover {
        background: linear-gradient(135deg, #e0f2f1, #b2dfdb);
        color: #1a3a2e;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #4db6ac, #26a69a);
        color: white;
        box-shadow: 0 3px 10px rgba(77, 182, 172, 0.3);
    }

    .price-text {
        font-weight: 700;
        color: #4db6ac;
        font-size: 1.05rem;
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
    <h4><i class="bi bi-cup-hot-fill"></i> Daftar Menu</h4>
    <a href="{{ route('menu.create') }}" class="btn btn-add">
        <i class="bi bi-plus-circle"></i> Tambah Menu
    </a>
</div>

<div class="menu-card">
    <div class="table-container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Menu</th>
                        <th width="150">Kategori</th>
                        <th width="150">Harga</th>
                        <th width="120">Status</th>
                        <th width="200" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($menus as $index => $menu)
                    <tr>
                        <td class="text-center">{{ $menus->firstItem() + $index }}</td>
                        <td>
                            <strong>{{ $menu->nama_menu }}</strong>
                            @if($menu->deskripsi)
                            <br><small class="text-muted">{{ Str::limit($menu->deskripsi, 50) }}</small>
                            @endif
                        </td>
                        <td>
                            <span class="badge-category 
                                @if($menu->kategori == 'Kopi') badge-kopi
                                @elseif($menu->kategori == 'Non Kopi') badge-non-kopi
                                @else badge-squash
                                @endif">
                                {{ $menu->kategori }}
                            </span>
                        </td>
                        <td class="price-text">Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                        <td>
                            <span class="status-badge {{ $menu->status == 'tersedia' ? 'status-tersedia' : 'status-habis' }}">
                                {{ ucfirst($menu->status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-edit btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('menu.destroy', $menu->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete btn-sm" 
                                        onclick="return confirm('Yakin ingin menghapus menu ini?')">
                                    <i class="bi bi-trash3"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <h5>Belum ada data menu</h5>
                                <p class="text-muted">Tambahkan menu pertama Anda sekarang</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($menus->hasPages())
        <div class="d-flex justify-content-center">
            {{ $menus->links() }}
        </div>
        @endif
    </div>
</div>
@endsection