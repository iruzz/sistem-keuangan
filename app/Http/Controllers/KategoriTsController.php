<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriTs;

class KategoriTsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = KategoriTs::all();
        return view('pages.superadmin.kategorits.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.superadmin.kategorits.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'tipe'         => 'required|in:Pemasukan,Pengeluaran',
        ]);

        KategoriTs::create($validated);

        return redirect()->route('superadmin.kategori')
            ->with('success', 'Kategori transaksi berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = KategoriTs::findOrFail($id);
        return view('pages.superadmin.kategorits.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kategori = KategoriTs::findOrFail($id);

        $validated = $request->validate([
            'nama_kategori'  => 'required|string|max:255',
            'tipe'      => 'required|in:Pemasukan,Pengeluaran',
        ]);

        $kategori->update($validated);

        return redirect()->route('superadmin.kategori');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = KategoriTs::findOrFail($id);
        $kategori->delete();

        return redirect()->route('superadmin.kategori')
            ->with('success', 'Kategori transaksi berhasil dihapus!');
    }
}
