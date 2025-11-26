<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Menu;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    // Halaman laporan
    public function index(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        // Data laporan
        $laporan = $this->generateLaporan($bulan, $tahun);

        return view('laporan.index', compact('laporan', 'bulan', 'tahun'));
    }

    // Export PDF
    public function exportPdf(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        $laporan = $this->generateLaporan($bulan, $tahun);

        $pdf = Pdf::loadView('laporan.pdf', compact('laporan', 'bulan', 'tahun'));
        
        $namaBulan = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
            '04' => 'April', '05' => 'Mei', '06' => 'Juni',
            '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
            '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];

        $filename = 'Laporan_Penjualan_' . $namaBulan[$bulan] . '_' . $tahun . '.pdf';
        
        return $pdf->download($filename);
    }

    // Generate data laporan
    private function generateLaporan($bulan, $tahun)
    {
        // Total transaksi
        $totalTransaksi = Transaksi::whereMonth('tanggal_transaksi', $bulan)
            ->whereYear('tanggal_transaksi', $tahun)
            ->count();

        // Total pendapatan
        $totalPendapatan = Transaksi::whereMonth('tanggal_transaksi', $bulan)
            ->whereYear('tanggal_transaksi', $tahun)
            ->sum('total_harga');

        // Produk terlaris (top 5)
        $produkTerlaris = DetailTransaksi::select('menu_id', DB::raw('SUM(jumlah) as total_terjual'))
            ->whereHas('transaksi', function($query) use ($bulan, $tahun) {
                $query->whereMonth('tanggal_transaksi', $bulan)
                      ->whereYear('tanggal_transaksi', $tahun);
            })
            ->groupBy('menu_id')
            ->orderBy('total_terjual', 'desc')
            ->limit(5)
            ->with('menu')
            ->get();

        // Transaksi per hari
        $transaksiPerHari = Transaksi::select(
                DB::raw('DATE(tanggal_transaksi) as tanggal'),
                DB::raw('COUNT(*) as jumlah'),
                DB::raw('SUM(total_harga) as pendapatan')
            )
            ->whereMonth('tanggal_transaksi', $bulan)
            ->whereYear('tanggal_transaksi', $tahun)
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        // Metode pembayaran
        $metodePembayaran = Transaksi::select('metode_pembayaran', DB::raw('COUNT(*) as jumlah'))
            ->whereMonth('tanggal_transaksi', $bulan)
            ->whereYear('tanggal_transaksi', $tahun)
            ->groupBy('metode_pembayaran')
            ->get();

        return [
            'total_transaksi' => $totalTransaksi,
            'total_pendapatan' => $totalPendapatan,
            'produk_terlaris' => $produkTerlaris,
            'transaksi_per_hari' => $transaksiPerHari,
            'metode_pembayaran' => $metodePembayaran,
        ];
    }
}