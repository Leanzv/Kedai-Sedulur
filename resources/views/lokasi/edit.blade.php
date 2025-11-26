@extends('layouts.app')

@section('title', 'Edit Lokasi')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    .form-container {
        max-width: 1100px;
        margin: 0 auto;
    }

    .form-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .form-header {
        background: linear-gradient(135deg, #e53935, #c62828);
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
        border-color: #e53935;
        background: white;
        box-shadow: 0 0 0 0.2rem rgba(229, 57, 53, 0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    .alert-info {
        background: linear-gradient(135deg, #e3f2fd, #bbdefb);
        border: none;
        border-left: 4px solid #2196f3;
        border-radius: 12px;
        color: #01579b;
        padding: 15px 20px;
    }

    .map-section {
        margin-top: 25px;
        padding: 25px;
        background: #f8f9fa;
        border-radius: 15px;
        border: 2px dashed #e0e0e0;
    }

    .map-title {
        font-weight: 700;
        color: #2d5a4a;
        font-size: 1.1rem;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .map-title i {
        color: #e53935;
        font-size: 1.3rem;
    }

    #map {
        height: 450px;
        border-radius: 15px;
        cursor: crosshair;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }

    .btn-back {
        background: #e0e0e0;
        color: #666;
        border: none;
        padding: 12px 30px;
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

    .btn-submit {
        background: linear-gradient(135deg, #e53935, #c62828);
        color: white;
        border: none;
        padding: 12px 35px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(229, 57, 53, 0.3);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(229, 57, 53, 0.4);
        color: white;
    }

    .form-footer {
        padding: 25px 40px;
        background: #f8f9fa;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .coordinate-badge {
        background: linear-gradient(135deg, #ffebee, #ffcdd2);
        color: #c62828;
        padding: 8px 15px;
        border-radius: 10px;
        font-size: 0.9rem;
        font-weight: 600;
        display: inline-block;
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

        .map-section {
            padding: 15px;
        }

        .map-section .d-flex {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 10px;
        }

        .coordinate-badge {
            width: 100%;
            text-align: center;
        }

        #map {
            height: 350px;
        }
    }
</style>
@endpush

@section('content')
<div class="form-container">
    <div class="form-card">
        <div class="form-header">
            <h5><i class="bi bi-geo-alt-fill"></i> Edit Lokasi</h5>
        </div>
        
        <form action="{{ route('lokasi.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Tempat <span class="text-danger">*</span></label>
                        <input type="text" name="nama_cafe" class="form-control @error('nama_cafe') is-invalid @enderror" 
                            placeholder="Contoh: Kopi Kita Café" value="{{ old('nama_cafe', $lokasi->nama_cafe ?? '') }}" required>
                        @error('nama_cafe')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" 
                            placeholder="Contoh: kedai ternyaman" value="{{ old('deskripsi', $lokasi->deskripsi ?? '') }}">
                        @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" 
                            placeholder="Contoh: Jl. Dr.Sutomo, Rambipuji" required>{{ old('alamat', $lokasi->alamat ?? '') }}</textarea>
                    @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Sembunyikan Koordinat -->
                <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude', $lokasi->latitude ?? '-7.265757') }}">
                <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude', $lokasi->longitude ?? '112.734146') }}">

                <div class="map-section">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="map-title" style="margin-bottom: 0;">
                            <i class="bi bi-pin-map-fill"></i>
                            Tentukan Lokasi di Peta
                        </div>
                        <span class="coordinate-badge">
                            <i class="bi bi-crosshair"></i> 
                            Koordinat Terpilih: <span id="coord-display">{{ $lokasi->latitude ?? '-7.265757' }}, {{ $lokasi->longitude ?? '112.734146' }}</span>
                        </span>
                    </div>
                    
                    <div id="map"></div>
                    
                    <div class="alert alert-info mt-3 mb-0">
                        <i class="bi bi-info-circle-fill"></i> 
                        <strong>Cara Menggunakan:</strong> 
                        Klik pada peta untuk menentukan lokasi café. Marker dapat di-drag untuk menyesuaikan posisi.
                    </div>
                </div>
            </div>

            <div class="form-footer">
                <a href="{{ route('lokasi.index') }}" class="btn btn-back">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-submit">
                    <i class="bi bi-save"></i> Simpan Lokasi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    // Inisialisasi Koordinat
    var lat = parseFloat(document.getElementById('latitude').value) || -8.20065365;
    var lng = parseFloat(document.getElementById('longitude').value) || 113.61396433;

    // Inisialisasi peta
    var map = L.map('map').setView([lat, lng], 15);

    // Tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Custom icon
    var cafeIcon = L.icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    // Marker peta
    var marker = L.marker([lat, lng], {
        draggable: true,
        icon: cafeIcon
    }).addTo(map);

    // Popup informasi
    marker.bindPopup("<strong style='color: #e53935;'>📍 Lokasi</strong><br><small>Drag marker untuk ubah posisi</small>").openPopup();

    // Update display koordinat
    function updateCoordinates(lat, lng) {
        document.getElementById('latitude').value = lat.toFixed(8);
        document.getElementById('longitude').value = lng.toFixed(8);
        document.getElementById('coord-display').textContent = lat.toFixed(6) + ', ' + lng.toFixed(6);
    }

    // Update koordinat saat marker di-drag
    marker.on('dragend', function(e) {
        var position = marker.getLatLng();
        updateCoordinates(position.lat, position.lng);
        marker.bindPopup("<strong style='color: #e53935;'>📍 Lokasi Baru</strong><br><small>Lat: " + position.lat.toFixed(6) + "<br>Lng: " + position.lng.toFixed(6) + "</small>").openPopup();
    });

    // Update marker dan koordinat saat peta diklik
    map.on('click', function(e) {
        marker.setLatLng(e.latlng);
        updateCoordinates(e.latlng.lat, e.latlng.lng);
        marker.bindPopup("<strong style='color: #e53935;'>📍 Lokasi Baru</strong><br><small>Lat: " + e.latlng.lat.toFixed(6) + "<br>Lng: " + e.latlng.lng.toFixed(6) + "</small>").openPopup();
    });
</script>
@endpush