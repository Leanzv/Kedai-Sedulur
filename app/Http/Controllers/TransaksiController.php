<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    // Halaman kasir
    public function index()
    {
        $menus = Menu::where('status', 'tersedia')->get();
        return view('transaksi.index', compact('menus'));
    }

    // Simpan transaksi
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.menu_id' => 'required|exists:menu,id',
            'items.*.jumlah' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|in:tunai,transfer,qris',
        ]);

        DB::beginTransaction();
        try {
            // Generate kode transaksi
            $kodeTransaksi = 'TRX-' . date('Ymd') . '-' . str_pad(Transaksi::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);

            // Hitung total harga
            $totalHarga = 0;
            foreach ($request->items as $item) {
                $menu = Menu::find($item['menu_id']);
                $totalHarga += $menu->harga * $item['jumlah'];
            }

            // Simpan transaksi
            $transaksi = Transaksi::create([
                'kode_transaksi' => $kodeTransaksi,
                'tanggal_transaksi' => now(),
                'total_harga' => $totalHarga,
                'metode_pembayaran' => $request->metode_pembayaran,
                'user_id' => Auth::id(),
            ]);

            // Simpan detail transaksi
            foreach ($request->items as $item) {
                $menu = Menu::find($item['menu_id']);
                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'menu_id' => $menu->id,
                    'jumlah' => $item['jumlah'],
                    'harga_satuan' => $menu->harga,
                    'subtotal' => $menu->harga * $item['jumlah'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil disimpan!',
                'kode_transaksi' => $kodeTransaksi,
                'total_harga' => $totalHarga,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan transaksi: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Daftar riwayat transaksi
    public function riwayat()
    {
        if (Auth::user()->role == 'admin') {
            $transaksis = Transaksi::with('user')->orderBy('created_at', 'desc')->paginate(20);
        } else {
            $transaksis = Transaksi::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(20);
        }
        
        return view('transaksi.riwayat', compact('transaksis'));
    }

    // Detail transaksi
    public function show($id)
    {
        $transaksi = Transaksi::with(['detailTransaksi.menu', 'user'])->findOrFail($id);
        
        // Cek akses admin dan pegawai
        if (Auth::user()->role != 'admin' && $transaksi->user_id != Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke transaksi ini');
        }

        return view('transaksi.detail', compact('transaksi'));
    }
}