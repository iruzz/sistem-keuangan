<?php

namespace App\Http\Controllers;

use App\Models\DetailTs;
use App\Models\Transaksi;
use App\Models\Akun;
use Illuminate\Http\Request;

class DetailTsController extends Controller
{
    // Tampilkan semua detail transaksi
    public function index()
    {
        $detail = DetailTs::with('transaksi', 'akun')->get();
        return view('pages.bendahara.detail_transaksi.index', ['detail' => $detail]);
    }

    // Tampilkan form create
    public function create()
    {
        $transaksi = Transaksi::all();
        $akun = Akun::all();
        return view('pages.bendahara.detail_transaksi.create', ['transaksi' => $transaksi, 'akun' => $akun]);
    }

    // Simpan detail transaksi
    public function store(Request $request)
    {
        DetailTs::create([
            'transaksi_id' => $request->transaksi_id,
            'akun_id' => $request->akun_id,
            'debit' => $request->debit ?? 0,
            'kredit' => $request->kredit ?? 0,
            'keterangan' => $request->keterangan,
        ]);

        return redirect('/bendahara/detail-transaksi')->with('success', 'Detail transaksi berhasil ditambahkan!');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $detail = DetailTs::find($id);
        $transaksi = Transaksi::all();
        $akun = Akun::all();
        return view('pages.bendahara.detail_transaksi.edit', ['detail' => $detail, 'transaksi' => $transaksi, 'akun' => $akun]);
    }

    // Update detail transaksi
    public function update(Request $request, $id)
    {
        $detail = DetailTs::find($id);
        $detail->update([
            'transaksi_id' => $request->transaksi_id,
            'akun_id' => $request->akun_id,
            'debit' => $request->debit ?? 0,
            'kredit' => $request->kredit ?? 0,
            'keterangan' => $request->keterangan,
        ]);

        return redirect('/bendahara/detail-transaksi')->with('success', 'Detail transaksi berhasil diubah!');
    }

    // Hapus detail transaksi
    public function destroy($id)
    {
        DetailTs::find($id)->delete();
        return redirect('/bendahara/detail-transaksi')->with('success', 'Detail transaksi berhasil dihapus!');
    }
}