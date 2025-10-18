<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $now = Carbon::now();

        DB::table('transaksi')->insert([
            [
                'kode_transaksi' => 'TRX-001',
                'tanggal' => '2024-10-01',
                'deskripsi' => 'Pembayaran pajak PPh 21',
                'tipe' => 'Pengeluaran',
                'total' => 2500000.00,
                'metode' => 'Transfer',
                'user_id' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
