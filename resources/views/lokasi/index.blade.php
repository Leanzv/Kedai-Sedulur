@extends('layouts.app')

@section('title', 'Lokasi')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    .page-header {
        background: linear-gradient(135deg, #e53935 0%, #c62828 100%);
        border-radius: 20px;
        padding: 25px 35px;
        margin-bottom: 25px;
        color: white;
        box-shadow: 0 5px 20px rgba(229, 57, 53, 0.3);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .page-header h5 {
        margin: 0;
        font-weight: 700;
        font-size: 1.6rem;
    }

    .btn-edit-lokasi {
        background: white;
        color: #e53935;
        border: none;
        padding: 10px 25px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        text-decoration: none;
        display: inline-block;
    }

    .btn-edit-lokasi:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        color: #e53935;
    }

    /* Info Card */
    .info-card {
        background: white;
        border-radius: 20px;
        padding: 35px;
        margin-bottom: 25px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        border-left: 5px solid #e53935;
    }

    .cafe-name {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1a3a2e;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .cafe-name i {
        color: #e53935;
        font-size: 2rem;
    }

    .info-item {
        margin-bottom: 20px;
    }

    .info-label {
        font-weight: 700;
        color: #2d5a4a;
        font-size: 1rem;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-label i {
        color: #e53935;
    }

    .info-value {
        color: #666;
        font-size: 1rem;
        line-height: 1.6;
    }

    .btn-direction {
        background: linear-gradient(135deg, #e53935, #c62828);
        color: white;
        border: none;
        padding: 14px 30px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(229, 57, 53, 0.3);
        text-decoration: none;
        display: inline-block;
        margin-top: 10px;
    }

    .btn-direction:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(229, 57, 53, 0.4);
        color: white;
    }

    .coordinates {
        background: linear-gradient(135deg, #ffebee, #ffcdd2);
        color: #c62828;
        padding: 10px 18px;
        border-radius: 10px;
        font-size: 0.9rem;
        font-weight: 600;
        display: inline-block;
        margin-top: 15px;
    }

    /* Map Card */
    .map-card {
        background: white;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    }

    .map-title {
        font-weight: 700;
        color: #2d5a4a;
        font-size: 1.2rem;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 3px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .map-title i {
        color: #e53935;
    }

    #map {
        height: 500px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }

    .alert-warning {
        background: linear-gradient(135deg, #fff3e0, #ffe0b2);
        border: none;
        border-left: 5px solid #ff9800;
        border-radius: 15px;
        color: #e65100;
    }

    .alert-warning .alert-link {
        color: #e53935;
        font-weight: 700;
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }

        .info-card {
            padding: 25px;
        }

        .cafe-name {
            font-size: 1.5rem;
        }

        #map {
            height: 350px;
        }
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <h5><i class="bi bi-geo-alt-fill"></i> Lokasi</h5>
    <a href="{{ route('lokasi.edit') }}" class="btn-edit-lokasi">
        <i class="bi bi-pencil-square"></i> Edit Lokasi
    </a>
</div>

@if($lokasi)
<!-- Info Card -->
<div class="row">
    <div class="col-lg-5 mb-4">
        <div class="info-card">
            <div class="cafe-name">
                {{ $lokasi->nama_cafe }}
            </div>

            <div class="info-item">
                <div class="info-label">
                    <i class="bi bi-geo-alt-fill"></i> Alamat Lengkap
                </div>
                <div class="info-value">{{ $lokasi->alamat }}</div>
            </div>

            @if($lokasi->deskripsi)
            <div class="info-item">
                <div class="info-label">
                    <i class="bi bi-info-circle-fill"></i> Deskripsi
                </div>
                <div class="info-value">{{ $lokasi->deskripsi }}</div>
            </div>
            @endif

            <hr class="my-4">

            <a href="https://www.google.com/maps/dir/?api=1&destination={{ $lokasi->latitude }},{{ $lokasi->longitude }}" 
               target="_blank" class="btn btn-direction">
                <i class="bi bi-geo"></i> Google Maps
            </a>

            <div class="coordinates">
                {{ $lokasi->latitude }}, {{ $lokasi->longitude }}
            </div>
        </div>
    </div>

    <div class="col-lg-7 mb-4">
        <div class="map-card">
            <h6 class="map-title">
                <i class="bi bi-geo-fill"></i> Peta Lokasi
            </h6>
            <div id="map"></div>
        </div>
    </div>
</div>
@else
<div class="alert alert-warning">
    <i class="bi bi-exclamation-triangle-fill"></i> 
    <strong>Lokasi kedai belum diatur.</strong><br>
    <a href="{{ route('lokasi.edit') }}" class="alert-link">Klik di sini</a> untuk mengatur lokasi tempat Anda.
</div>
@endif
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
@if($lokasi)
    // Inisialisasi peta
    var map = L.map('map').setView([{{ $lokasi->latitude }}, {{ $lokasi->longitude }}], 15);

    // Title layer
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
    var marker = L.marker([{{ $lokasi->latitude }}, {{ $lokasi->longitude }}], {
        icon: cafeIcon
    }).addTo(map);

    // Popup informasi
    marker.bindPopup(`
        <div style="text-align: center; padding: 5px;">
            <strong style="color: #e53935; font-size: 1.1rem;">{{ $lokasi->nama_cafe }}</strong><br>
            <small style="color: #666;">{{ $lokasi->alamat }}</small>
        </div>
    `).openPopup();
@endif
</script>
@endpush