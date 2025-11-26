@extends('layouts.app')

@section('title', 'Transaksi')

@push('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, #66bb6a 0%, #43a047 100%);
        border-radius: 20px;
        padding: 25px 35px;
        margin-bottom: 25px;
        color: white;
        box-shadow: 0 5px 20px rgba(102, 187, 106, 0.3);
    }

    .page-header h5 {
        margin: 0;
        font-weight: 700;
        font-size: 1.6rem;
    }

    /* Menu Section */
    .menu-section {
        background: white;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        height: 615px;
        overflow-y: auto;
    }

    .section-title {
        font-weight: 700;
        color: #2d5a4a;
        font-size: 1.2rem;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 3px solid #e0f2f1;
    }

    .menu-card {
        cursor: pointer;
        transition: all 0.3s;
        height: 100%;
        border: 2px solid #e0e0e0;
        border-radius: 15px;
        overflow: hidden;
        background: linear-gradient(135deg, #f8f9fa, #ffffff);
    }

    .menu-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(102, 187, 106, 0.3);
        border-color: #66bb6a;
    }

    .menu-card-body {
        padding: 20px;
        text-align: center;
    }

    .menu-icon-small {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
    }

    .menu-icon-small i {
        font-size: 1.8rem;
        color: white;
    }

    .icon-kopi {
        background: linear-gradient(135deg, #8d6e63, #6d4c41);
    }

    .icon-nonkopi {
        background: linear-gradient(135deg, #66bb6a, #43a047);
    }

    .icon-squash {
        background: linear-gradient(135deg, #29b6f6, #039be5);
    }

    .menu-name {
        font-weight: 700;
        color: #1a3a2e;
        font-size: 1rem;
        margin-bottom: 8px;
    }

    .menu-category-small {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 10px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .category-kopi {
        background: linear-gradient(135deg, #d7ccc8, #bcaaa4);
        color: #4e342e;
    }

    .category-nonkopi {
        background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
        color: #2e7d32;
    }

    .category-squash {
        background: linear-gradient(135deg, #e1f5fe, #b3e5fc);
        color: #01579b;
    }

    .menu-price {
        color: #43a047;
        font-weight: 700;
        font-size: 1.1rem;
        margin-top: 8px;
    }

    /* Cart Section */
    .cart-section {
        background: white;
        border-radius: 20px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        position: sticky;
        top: 100px;
        z-index: 100;
    }

    .cart-header {
        background: linear-gradient(135deg, #66bb6a, #43a047);
        padding: 20px 25px;
        color: white;
        border-radius: 20px 20px 0 0;
    }

    .cart-header h5 {
        margin: 0;
        font-weight: 700;
        font-size: 1.3rem;
    }

    .cart-body {
        padding: 25px;
        max-height: 240px;
        min-height: 240px;
        overflow-y: auto;
    }

    .cart-body::-webkit-scrollbar {
        width: 6px;
    }

    .cart-body::-webkit-scrollbar-track {
        background: #f0f0f0;
        border-radius: 10px;
    }

    .cart-body::-webkit-scrollbar-thumb {
        background: #66bb6a;
        border-radius: 10px;
    }

    .cart-item {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 12px;
        border-left: 4px solid #66bb6a;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .cart-item-info {
        flex: 1;
    }

    .cart-item-name {
        font-weight: 700;
        color: #1a3a2e;
        font-size: 0.95rem;
        margin-bottom: 5px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .cart-item-price {
        font-size: 0.85rem;
        color: #666;
    }

    .cart-item-qty {
        background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
        color: #2e7d32;
        padding: 4px 12px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.85rem;
    }

    .btn-remove {
        background: linear-gradient(135deg, #ef5350, #e53935);
        color: white;
        border: none;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 0.9rem;
        transition: all 0.3s;
        cursor: pointer;
    }

    .btn-remove:hover {
        transform: scale(1.05);
        box-shadow: 0 3px 10px rgba(239, 83, 80, 0.4);
    }


    /* .cart-item-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    } */

    /* .qty-input {
        width: 70px;
        text-align: center;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        padding: 6px;
        font-weight: 600;
    } */

    /* .qty-input:focus {
        border-color: #66bb6a;
        outline: none;
    } */

    /* .btn-remove {
        background: linear-gradient(135deg, #ef5350, #e53935);
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.3s;
    } */

    /* .btn-remove:hover {
        transform: scale(1.05);
        box-shadow: 0 3px 10px rgba(239, 83, 80, 0.4);
    } */

    /* .cart-subtotal {
        text-align: right;
        font-weight: 700;
        color: #43a047;
        margin-top: 5px;
    } */

    .cart-empty {
        text-align: center;
        color: #999;
        padding: 40px 20px;
    }

    .cart-empty i {
        font-size: 3rem;
        margin-bottom: 15px;
        color: #ddd;
    }

    .cart-summary {
        padding: 20px 25px;
        border-top: 2px solid #f0f0f0;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .total-label {
        font-weight: 700;
        color: #2d5a4a;
        font-size: 1.1rem;
    }

    .total-value {
        font-weight: 700;
        color: #43a047;
        font-size: 1.5rem;
    }

    .form-label {
        color: #2d5a4a;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    .form-select {
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        padding: 10px 15px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .form-select:focus {
        border-color: #66bb6a;
        box-shadow: 0 0 0 0.2rem rgba(102, 187, 106, 0.1);
    }

    .btn-process {
        background: linear-gradient(135deg, #66bb6a, #43a047);
        color: white;
        border: none;
        padding: 14px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        width: 100%;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(102, 187, 106, 0.3);
        margin-bottom: 10px;
    }

    .btn-process:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 187, 106, 0.4);
    }

    .btn-reset {
        background: #f5f5f5;
        color: #666;
        border: 2px solid #e0e0e0;
        padding: 12px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        width: 100%;
        transition: all 0.3s;
    }

    .btn-reset:hover {
        background: #e0e0e0;
        border-color: #d0d0d0;
    }

    /* Success Modal */
    .modal-content {
        border-radius: 20px;
        border: none;
        overflow: hidden;
    }

    .modal-header {
        background: linear-gradient(135deg, #66bb6a, #43a047);
        color: white;
        border: none;
        padding: 25px;
    }

    .modal-body {
        padding: 40px;
    }

    .success-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }

    .success-icon i {
        font-size: 3rem;
        color: #43a047;
    }

    .modal-footer {
        border: none;
        padding: 20px 40px 30px;
    }

    @media (max-width: 768px) {
        .menu-section {
            height: auto;
            margin-bottom: 20px;
        }

        .cart-section {
            position: relative;
            top: 0;
        }
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <h5><i class="bi bi-cart-check-fill"></i> Transaksi Penjualan</h5>
</div>

<div class="row">
    <!-- Menu Section -->
    <div class="col-lg-7 mb-4">
        <div class="menu-section">
            <h6 class="section-title"><i class="bi bi-grid-3x3-gap-fill"></i> Pilih Menu</h6>
            <div class="row g-3">
                @foreach($menus as $menu)
                <div class="col-md-4 col-sm-6">
                    <div class="menu-card" onclick="addToCart({{ $menu->id }}, '{{ $menu->nama_menu }}', {{ $menu->harga }})">
                        <div class="menu-card-body">
                            <div class="menu-icon-small 
                                @if($menu->kategori == 'Kopi') icon-kopi
                                @elseif($menu->kategori == 'Non Kopi') icon-nonkopi
                                @else icon-squash
                                @endif">
                                @if($menu->kategori == 'Kopi')
                                    <i class="bi bi-cup-hot"></i>
                                @elseif($menu->kategori == 'Non Kopi')
                                    <i class="bi bi-cup-straw"></i>
                                @else
                                    <i class="bi bi-droplet"></i>
                                @endif
                            </div>
                            <div class="menu-name">{{ $menu->nama_menu }}</div>
                            <span class="menu-category-small
                                @if($menu->kategori == 'Kopi') category-kopi
                                @elseif($menu->kategori == 'Non Kopi') category-nonkopi
                                @else category-squash
                                @endif">
                                {{ $menu->kategori }}
                            </span>
                            <div class="menu-price">Rp {{ number_format($menu->harga, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Cart Section -->
    <div class="col-lg-5">
        <div class="cart-section">
            <div class="cart-header">
                <h5><i class="bi bi-cart3"></i> Keranjang Belanja</h5>
            </div>

            <div class="cart-body" id="cart-items">
                <div class="cart-empty">
                    <i class="bi bi-cart-x"></i>
                    <p>Keranjang masih kosong</p>
                </div>
            </div>

            <div class="cart-summary">
                <div class="total-row">
                    <span class="total-label">Total Pembayaran:</span>
                    <span class="total-value" id="total-harga">Rp 0</span>
                </div>

                <div class="mb-3">
                    <label class="form-label">Metode Pembayaran</label>
                    <select id="metode-pembayaran" class="form-select">
                        <option value="tunai">Cash</option>
                        <option value="qris">QRIS</option>
                    </select>
                </div>

                <button class="btn btn-process" onclick="prosesTransaksi()">
                    <i class="bi bi-check-circle"></i> Proses Pembayaran
                </button>
                <button class="btn btn-reset" onclick="resetCart()">
                    <i class="bi bi-arrow-clockwise"></i> Reset Keranjang
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-check-circle"></i> Transaksi Berhasil!</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <div class="success-icon">
                    <i class="bi bi-check-lg"></i>
                </div>
                <h5 class="mb-3">Kode Transaksi</h5>
                <h3 id="modal-kode-transaksi" class="text-success mb-3"></h3>
                <p class="mb-2">Total Pembayaran</p>
                <h4 id="modal-total-harga" class="text-success"></h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success w-100" onclick="location.reload()">
                    <i class="bi bi-plus-circle"></i> Transaksi Baru
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let cart = [];

function addToCart(id, nama, harga) {
    let existingItem = cart.find(item => item.menu_id === id);
    
    if (existingItem) {
        existingItem.jumlah++;
    } else {
        cart.push({
            menu_id: id,
            nama: nama,
            harga: harga,
            jumlah: 1
        });
    }
    
    renderCart();
}

function removeFromCart(id) {
    cart = cart.filter(item => item.menu_id !== id);
    renderCart();
}

function renderCart() {
    let cartHtml = '';
    let total = 0;
    
    if (cart.length === 0) {
        cartHtml = `
            <div class="cart-empty">
                <i class="bi bi-cart-x"></i>
                <p>Keranjang masih kosong</p>
            </div>
        `;
    } else {
        cart.forEach(item => {
            let subtotal = item.harga * item.jumlah;
            total += subtotal;
            
            cartHtml += `
                <div class="cart-item">
                    <div class="cart-item-info">
                        <div class="cart-item-name">
                            ${item.nama} 
                            <span class="cart-item-qty">${item.jumlah}x</span>
                        </div>
                        <div class="cart-item-price">Rp ${item.harga.toLocaleString('id-ID')} × ${item.jumlah} = Rp ${subtotal.toLocaleString('id-ID')}</div>
                    </div>
                    <button class="btn-remove" onclick="removeFromCart(${item.menu_id})">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            `;
        });
    }
    
    document.getElementById('cart-items').innerHTML = cartHtml;
    document.getElementById('total-harga').textContent = 'Rp ' + total.toLocaleString('id-ID');
}

function resetCart() {
    if (confirm('Yakin ingin reset keranjang?')) {
        cart = [];
        renderCart();
    }
}

function prosesTransaksi() {
    if (cart.length === 0) {
        alert('Keranjang masih kosong!');
        return;
    }
    
    let metodePembayaran = document.getElementById('metode-pembayaran').value;
    
    fetch('{{ route("transaksi.store") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            items: cart,
            metode_pembayaran: metodePembayaran
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('modal-kode-transaksi').textContent = data.kode_transaksi;
            document.getElementById('modal-total-harga').textContent = 'Rp ' + data.total_harga.toLocaleString('id-ID');
            
            let modal = new bootstrap.Modal(document.getElementById('successModal'));
            modal.show();
            
            cart = [];
            renderCart();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        alert('Terjadi kesalahan saat memproses transaksi');
        console.error(error);
    });
}
</script>
@endpush