<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTs extends Model
{
    protected $table = 'detail_transaksi';
    
    protected $fillable = [
        'transaksi_id',
        'akun_id',
        'debit',
        'kredit',
        'keterangan'
    ];
    
    protected $casts = [
        'debit' => 'decimal:2',
        'kredit' => 'decimal:2'
    ];

    // Relasi: Banyak detail punya 1 transaksi
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    // Relasi: Banyak detail punya 1 akun
    public function akun()
    {
        return $this->belongsTo(Akun::class, 'akun_id');
    }
}