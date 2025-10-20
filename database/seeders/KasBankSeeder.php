<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KasBankSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        DB::table('kas_bank')->insert([
            [
                'nama_rekening' => 'Kas Tunai',
                'nomor_rekening' => null,
                'tipe' => 'Kas',
                'saldo' => 50000000.00,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}