<?php

namespace App\Http\Controllers;

use App\Models\KasBank;
use Illuminate\Http\Request;

class KasBankController extends Controller
{
    // Index - Tampilkan semua kas bank
    public function index()
    {
        $kasBank = KasBank::all();
        return view('pages.bendahara.kas_bank.index', ['kasBank' => $kasBank]);
    }

    // Create - Tampilkan form create
    public function create()
    {
        return view('pages.bendahara.kas_bank.create');
    }

    // Store - Simpan kas bank baru
    public function store(Request $request)
    {
        KasBank::create([
            'nama_rekening' => $request->nama_rekening,
            'nomor_rekening' => $request->nomor_rekening,
            'tipe' => $request->tipe,
            'saldo' => $request->saldo ?: 0,
        ]);

        return redirect(route('bendahara.kasBank'))->with('success', 'Kas/Bank berhasil ditambahkan!');
    }

    // Edit - Tampilkan form edit
    public function edit($id)
    {
        $kasBank = KasBank::findOrFail($id);
        return view('pages.bendahara.kas_bank.edit', ['kasBank' => $kasBank]);
    }

    // Update - Update kas bank
    public function update(Request $request, $id)
    {
        $kasBank = KasBank::findOrFail($id);
        $kasBank->update([
            'nama_rekening' => $request->nama_rekening,
            'nomor_rekening' => $request->nomor_rekening,
            'tipe' => $request->tipe,
            'saldo' => $request->saldo ?: 0,
        ]);

        return redirect(route('bendahara.kasBank'))->with('success', 'Kas/Bank berhasil diubah!');
    }

    // Destroy - Hapus kas bank
    public function destroy($id)
    {
        KasBank::findOrFail($id)->delete();
        return redirect(route('bendahara.kasBank'))->with('success', 'Kas/Bank berhasil dihapus!');
    }
}