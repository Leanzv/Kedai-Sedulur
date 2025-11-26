<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // Tampilkan daftar menu
    public function index()
    {
        $menus = Menu::orderBy('created_at', 'desc')->paginate(10);
        return view('menu.index', compact('menus'));
    }

    // Form tambah menu
    public function create()
    {
        return view('menu.create');
    }

    // Simpan menu baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|max:255',
            'kategori' => 'required',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable',
            'status' => 'required|in:tersedia,habis',
        ]);

        Menu::create($request->all());

        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    // Form edit menu
    public function edit(Menu $menu)
    {
        return view('menu.edit', compact('menu'));
    }

    // Update menu
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nama_menu' => 'required|max:255',
            'kategori' => 'required',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable',
            'status' => 'required|in:tersedia,habis',
        ]);

        $menu->update($request->all());

        return redirect()->route('menu.index')->with('success', 'Menu berhasil diupdate!');
    }

    // Hapus menu
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus!');
    }
}