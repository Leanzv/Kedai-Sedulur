<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KasirController extends Controller
{
    // Tampilkan daftar kasir
    public function index()
    {
        $kasirs = User::where('role', 'kasir')->orderBy('created_at', 'desc')->paginate(10);
        return view('kasir.index', compact('kasirs'));
    }

    // Form tambah kasir
    public function create()
    {
        return view('kasir.create');
    }

    // Simpan kasir baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'username' => 'required|unique:users,username|max:255',
            'password' => 'required|min:6',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'kasir',
            'status' => $request->status,
        ]);

        return redirect()->route('kasir.index')->with('success', 'Kasir berhasil ditambahkan!');
    }

    // Form edit kasir
    public function edit(User $kasir)
    {
        return view('kasir.edit', compact('kasir'));
    }

    // Update kasir
    public function update(Request $request, User $kasir)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username,' . $kasir->id,
            'password' => 'nullable|min:6',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $data = [
            'nama' => $request->nama,
            'username' => $request->username,
            'status' => $request->status,
        ];

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $kasir->update($data);

        return redirect()->route('kasir.index')->with('success', 'Kasir berhasil diupdate!');
    }

    // Hapus kasir
    public function destroy(User $kasir)
    {
        $kasir->delete();
        return redirect()->route('kasir.index')->with('success', 'Kasir berhasil dihapus!');
    }
}