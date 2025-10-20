<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    // 🔹 Tampilkan semua data akun
    public function index()
    {
        $data = Akun::all();

        return view('pages.superadmin.akun.index', compact('data'));
    }

    // 🔹 Tampilkan form tambah
    public function create()
    {
        return view('pages.superadmin.akun.create');
    }

    // 🔹 Simpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_akun'  => 'required|string|max:20|unique:akun,kode_akun',
            'nama_akun'  => 'required|string|max:255',
            'jenis'      => 'required|in:Aset,Kewajiban,Modal,Pendapatan,Beban',
            'saldo_awal' => 'required|numeric|min:0',
        ]);

        Akun::create($validated);

        return redirect()->route('superadmin.akun')
            ->with('success', 'Akun keuangan berhasil ditambahkan!');
    }

    // 🔹 Tampilkan form edit
    public function edit($id)
    {
        $akun = Akun::findOrFail($id);
        return view('pages.superadmin.akun.edit', compact('akun'));
    }

    // 🔹 Update data
    public function update(Request $request, $id)
    {
        $akun = Akun::findOrFail($id);

        $validated = $request->validate([
            'kode_akun'  => 'required|string|max:20|unique:akun,kode_akun,' . $akun->id,
            'nama_akun'  => 'required|string|max:255',
            'jenis'      => 'required|in:Aset,Kewajiban,Modal,Pendapatan,Beban',
            'saldo_awal' => 'required|numeric|min:0',
        ]);

        $akun->update($validated);

        return redirect()->route('superadmin.akun')
            ->with('success', 'Data akun berhasil diperbarui!');
    }

    // 🔹 Hapus data
    public function destroy($id)
    {
        $akun = Akun::findOrFail($id);
        $akun->delete();

        return redirect()->route('superadmin.akun')
            ->with('success', 'Akun keuangan berhasil dihapus!');
    }
}
