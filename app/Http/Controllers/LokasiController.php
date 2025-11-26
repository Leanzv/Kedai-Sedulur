<?php

namespace App\Http\Controllers;

use App\Models\LokasiCafe;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    // Tampilkan halaman lokasi
    public function index()
    {
        $lokasi = LokasiCafe::first();
        return view('lokasi.index', compact('lokasi'));
    }

    // Form edit lokasi
    public function edit()
    {
        $lokasi = LokasiCafe::first();
        return view('lokasi.edit', compact('lokasi'));
    }

    // Update lokasi
    public function update(Request $request)
    {
        $request->validate([
            'nama_cafe' => 'required|max:255',
            'alamat' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'deskripsi' => 'nullable',
        ]);

        $lokasi = LokasiCafe::first();

        if ($lokasi) {
            $lokasi->update($request->all());
        } else {
            LokasiCafe::create($request->all());
        }

        return redirect()->route('lokasi.index')->with('success', 'Lokasi café berhasil diupdate!');
    }
}