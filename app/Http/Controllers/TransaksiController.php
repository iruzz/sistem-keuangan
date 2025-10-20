<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaksi;


class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = Transaksi::with('user')->latest('tanggal')->paginate(10);
        
        return view('pages.bendahara.transaksi.index', compact('transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('pages.bendahara.transaksi.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         Transaksi::create([
            'kode_transaksi' => $request->kode_transaksi,
            'tanggal' => date('Y-m-d'),
            'deskripsi' => $request->deskripsi,
            'tipe' => $request->tipe,
            'total' => $request->total,
            'metode' => $request->metode,
            'user_id' => auth()->id(),
        ]);

        return redirect('/bendahara/transaksi')->with('success', 'Transaksi berhasil ditambahkan!');
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
        $transaksi = Transaksi::findOrFail($id);
        return view('pages.bendahara.transaksi.edit', compact('transaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $transaksi = Transaksi::find($id);

    $transaksi->kode_transaksi = $request->kode_transaksi;
    $transaksi->tanggal = $request->tanggal ?: now()->toDateString(); // ← otomatis isi tanggal hari ini
    $transaksi->deskripsi = $request->deskripsi;
    $transaksi->tipe = $request->tipe;
    $transaksi->total = $request->total;
    $transaksi->metode = $request->metode;

    $transaksi->save();

    return redirect()->route('bendahara.transaksi')->with('success', 'Data berhasil diupdate!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();
        return redirect()->route('bendahara.transaksi');
    }
}
