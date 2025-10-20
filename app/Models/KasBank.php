<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KasBank extends Model
{
    protected $table = 'kas_bank';
    
    protected $fillable = [
        'nama_rekening',
        'nomor_rekening',
        'tipe',
        'saldo'
    ];
    
    protected $casts = [
        'saldo' => 'decimal:2'
    ];
}