<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h2 {
            margin: 5px 0;
        }
        .info-box {
            background: #f8f9fa;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .summary {
            display: flex;
            justify-content: space-between;
            margin: 15px 0;
        }
        .summary-item {
            flex: 1;
            padding: 10px;
            background: #e9ecef;
            margin: 0 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Kedai Sedulur Management System</h2>
        <h3>Laporan Penjualan</h3>
        <?php
            $namaBulan = [
                '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
                '04' => 'April', '05' => 'Mei', '06' => 'Juni',
                '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
                '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
            ];
        ?>
        <p>Periode: {{ $namaBulan[$bulan] }} {{ $tahun }}</p>
        <p>Dicetak: {{ date('d M Y H:i') }}</p>
    </div>

    <div class="info-box">
        <table style="border: none;">
            <tr>
                <td style="border: none;"><strong>Total Transaksi:</strong></td>
                <td style="border: none;">{{ $laporan['total_transaksi'] }} transaksi</td>
                <td style="border: none;"><strong>Total Pendapatan:</strong></td>
                <td style="border: none;">Rp {{ number_format($laporan['total_pendapatan'], 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="border: none;"><strong>Rata-rata per Transaksi:</strong></td>
                <td style="border: none;">Rp {{ $laporan['total_transaksi'] > 0 ? number_format($laporan['total_pendapatan'] / $laporan['total_transaksi'], 0, ',', '.') : 0 }}</td>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
            </tr>
        </table>
    </div>

    <h4>Top 5 Produk Terlaris</h4>
    <table>
        <thead>
            <tr>
                <th class="text-center">Peringkat</th>
                <th>Nama Menu</th>
                <th>Kategori</th>
                <th class="text-center">Total Terjual</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporan['produk_terlaris'] as $index => $produk)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $produk->menu->nama_menu }}</td>
                <td>{{ $produk->menu->kategori }}</td>
                <td class="text-center">{{ $produk->total_terjual }} porsi</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <h4>Metode Pembayaran</h4>
    <table>
        <thead>
            <tr>
                <th>Metode</th>
                <th class="text-center">Jumlah Transaksi</th>
                <th class="text-center">Persentase</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan['metode_pembayaran'] as $metode)
            <tr>
                <td>{{ ucfirst($metode->metode_pembayaran) }}</td>
                <td class="text-center">{{ $metode->jumlah }}</td>
                <td class="text-center">{{ $laporan['total_transaksi'] > 0 ? number_format($metode->jumlah / $laporan['total_transaksi'] * 100, 1) : 0 }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Transaksi Per Hari</h4>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th class="text-center">Jumlah Transaksi</th>
                <th class="text-right">Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporan['transaksi_per_hari'] as $data)
            <tr>
                <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('d M Y') }}</td>
                <td class="text-center">{{ $data->jumlah }}</td>
                <td class="text-right">Rp {{ number_format($data->pendapatan, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">Belum ada data</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr style="background: #f2f2f2;">
                <th colspan="2" class="text-right">TOTAL</th>
                <th class="text-right">Rp {{ number_format($laporan['total_pendapatan'], 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <p style="margin-top: 30px; text-align: right;">
        <strong>Dibuat oleh: {{ Auth::user()->nama }}</strong>
    </p>
</body>
</html>