@extends('layouts.app')

@section('title', 'Tambah Kasir')

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
        background: linear-gradient(135deg, #29b6f6, #039be5);
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
        border-color: #29b6f6;
        background: white;
        box-shadow: 0 0 0 0.2rem rgba(41, 182, 246, 0.1);
    }

    .form-text {
        font-size: 0.85rem;
        color: #666;
        margin-top: 5px;
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
        background: linear-gradient(135deg, #29b6f6, #039be5);
        color: white;
        border: none;
        padding: 12px 35px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(41, 182, 246, 0.3);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(41, 182, 246, 0.4);
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
            <h5><i class="bi bi-person-plus"></i> Tambah Kasir Baru</h5>
        </div>
        
        <form action="{{ route('kasir.store') }}" method="POST">
            @csrf
            
            <div class="form-body">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                           placeholder="Contoh: Rafli Adriansyah" value="{{ old('nama') }}" required>
                    @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Username <span class="text-danger">*</span></label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" 
                               placeholder="Contoh: rafly" value="{{ old('username') }}" required>
                        @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                               placeholder="Min. 6 karakter" required>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-footer">
                <a href="{{ route('kasir.index') }}" class="btn btn-back">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-submit">
                    <i class="bi bi-save"></i> Simpan Kasir
                </button>
            </div>
        </form>
    </div>
</div>
@endsection