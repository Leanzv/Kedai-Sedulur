<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Transaksi;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMenu = Menu::count();
        $totalTransaksi = Transaksi::count();
        $totalPendapatan = Transaksi::sum('total_harga');
        $totalKasir = User::where('role', 'kasir')->count();

        return view('dashboard', compact('totalMenu', 'totalTransaksi', 'totalPendapatan', 'totalKasir'));
    }
}