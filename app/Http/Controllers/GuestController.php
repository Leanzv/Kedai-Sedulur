<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\LokasiCafe;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    // Halaman utama guest (menu)
    public function index()
    {
        $menus = Menu::where('status', 'tersedia')->get();
        $lokasi = LokasiCafe::first();
        
        return view('guest.index', compact('menus', 'lokasi'));
    }
}