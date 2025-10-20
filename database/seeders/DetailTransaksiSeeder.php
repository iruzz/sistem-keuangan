<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DetailTransaksiSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        DB::table('detail_transaksi')->insert([
            [
                'transaksi_id' => 1,
                'akun_id' => 1,
                'debit' => 0,
                'kredit' => 2500000.00,
                'keterangan' => 'Kas dikeluarkan untuk Pajak',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}