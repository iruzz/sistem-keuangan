<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\KasBank;

class BendaharaDashboard extends Controller
{
   public function dashboard()
{
    // Data Real dari Database
    $transaksiTerbaru = Transaksi::with('user')->latest()->limit(10)->get();
    $kasBankList = KasBank::all();
    $totalSaldo = KasBank::sum('saldo');
    $jumlahKasBank = KasBank::count();
    $jumlahTransaksi = Transaksi::count();
    $totalPemasukan = Transaksi::where('tipe', 'Pemasukan')->sum('total');
    $totalPengeluaran = Transaksi::where('tipe', 'Pengeluaran')->sum('total');

    // Hitung data bulanan dari database
    $dataBulanan = Transaksi::selectRaw('MONTH(tanggal) as bulan, SUM(CASE WHEN tipe = "Pemasukan" THEN total ELSE 0 END) as pemasukan, SUM(CASE WHEN tipe = "Pengeluaran" THEN total ELSE 0 END) as pengeluaran')
        ->whereYear('tanggal', date('Y'))
        ->groupBy('bulan')
        ->get()
        ->keyBy('bulan');

    // Format data untuk chart (12 bulan)
    $bulanLabels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    $pemasukkanBulanan = [];
    $pengeluaranBulanan = [];
    $selisihBulanan = [];

    for($i = 1; $i <= 12; $i++) {
        $data = $dataBulanan->get($i);
        $p = $data->pemasukan ?? 0;
        $e = $data->pengeluaran ?? 0;
        
        $pemasukkanBulanan[] = $p;
        $pengeluaranBulanan[] = $e;
        $selisihBulanan[] = $p - $e;
    }

    return view('pages.bendahara.dashboard', compact(
        'transaksiTerbaru', 'kasBankList', 'totalSaldo', 'jumlahKasBank',
        'jumlahTransaksi', 'totalPemasukan', 'totalPengeluaran',
        'bulanLabels', 'pemasukkanBulanan', 'pengeluaranBulanan', 'selisihBulanan'
    ));
}
}
