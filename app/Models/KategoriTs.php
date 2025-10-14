<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriTs extends Model
{
    protected $table = 'kategori_transaksi';

    protected $fillable = [
        'nama_kategori',
        'tipe'
    ];
}
