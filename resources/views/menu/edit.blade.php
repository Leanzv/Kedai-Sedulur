@extends('layouts.app')

@section('title', 'Edit Menu')

@push('styles')
<style>
    .form-container {
        max-width: 900px;
        margin: 0 auto;
    }

    .form-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .form-header {
        background: linear-gradient(135deg, #ffa726, #fb8c00);
        padding: 30px 40px;
        color: white;
    }

    .form-header h5 {
        margin: 0;
        font-weight: 700;
        font-size: 1.5rem;
    }

    .form-body {
        padding: 40px;
    }

    .form-label {
        color: #2d5a4a;
        font-weight: 600;
        margin-bottom: 10px;
        font-size: 0.95rem;
    }

    .form-label .text-danger {
        font-size: 1.1rem;
    }

    .form-control, .form-select {
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        padding: 12px 18px;
        font-size: 0.95rem;
        transition: all 0.3s;
        background: #f8f9fa;
    }

    .form-control:focus, .form-select:focus {
        border-color: #ffa726;
        background: white;
        box-shadow: 0 0 0 0.2rem rgba(255, 167, 38, 0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    .btn-back {
        background: #e0e0e0;
        color: #666;
        border: none;
        padding: 12px 30px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-back:hover {
        background: #d0d0d0;
        transform: translateY(-2px);
        color: #666;
    }

    .btn-submit {
        background: linear-gradient(135deg, #ffa726, #fb8c00);
        color: white;
        border: none;
        padding: 12px 35px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(255, 167, 38, 0.3);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 167, 38, 0.4);
        color: white;
    }

    .form-footer {
        padding: 25px 40px;
        background: #f8f9fa;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .invalid-feedback {
        font-size: 0.875rem;
        margin-top: 8px;
    }

    @media (max-width: 768px) {
        .form-header, .form-body, .form-footer {
            padding: 25px;
        }

        .form-footer {
            flex-direction: column;
            gap: 10px;
        }

        .btn-back, .btn-submit {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="form-container">
    <div class="form-card">
        <div class="form-header">
            <h5><i class="bi bi-pencil-square"></i> Edit Menu</h5>
        </div>
        
        <form action="{{ route('menu.update', $menu->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-body">
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Nama Menu <span class="text-danger">*</span></label>
                        <input type="text" name="nama_menu" class="form-control @error('nama_menu') is-invalid @enderror" 
                               placeholder="Contoh: Cappuccino" value="{{ old('nama_menu', $menu->nama_menu) }}" required>
                        @error('nama_menu')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                            <option value="">-- Pilih --</option>
                            <option value="Kopi" {{ old('kategori', $menu->kategori) == 'Kopi' ? 'selected' : '' }}>Kopi</option>
                            <option value="Non Kopi" {{ old('kategori', $menu->kategori) == 'Non Kopi' ? 'selected' : '' }}>Non Kopi</option>
                            <option value="Squash" {{ old('kategori', $menu->kategori) == 'Squash' ? 'selected' : '' }}>Squash</option>
                        </select>
                        @error('kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Harga <span class="text-danger">*</span></label>
                        <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror" 
                               placeholder="Contoh: 25000" value="{{ old('harga', $menu->harga) }}" min="0" required>
                        @error('harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="tersedia" {{ old('status', $menu->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="habis" {{ old('status', $menu->status) == 'habis' ? 'selected' : '' }}>Habis</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" 
                              placeholder="Deskripsi singkat menu (opsional)">{{ old('deskripsi', $menu->deskripsi) }}</textarea>
                    @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-footer">
                <a href="{{ route('menu.index') }}" class="btn btn-back">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-submit">
                    <i class="bi bi-save"></i> Update Menu
                </button>
            </div>
        </form>
    </div>
</div>
@endsection