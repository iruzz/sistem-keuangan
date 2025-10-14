<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Akun;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Akun::create([
            'kode_akun'  => '1001',
            'nama_akun'  => 'Kas',
            'jenis'      => 'Aset',
            'saldo_awal' => 1000000.00,
        ]);
    }
}
