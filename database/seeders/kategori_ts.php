<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KategoriTs;

class kategori_ts extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriTs::create([
            'nama_kategori' => 'Pajak',
            'tipe' => 'Pengeluaran'
        ]);
    }
}
