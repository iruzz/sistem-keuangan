<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = [
        'kode_transaksi',
        'tanggal',
        'deskripsi',
        'tipe',
        'total',
        'metode',
        'user_id'
    ];
    protected $casts = [
        'tanggal' => 'date',
        'total' => 'decimal:2'
    ];

    // Relasi: Banyak transaksi dibuat oleh 1 user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Scope: Filter by tipe
    public function scopeByTipe($query, $tipe)
    {
        return $query->where('tipe', $tipe);
    }

    // Scope: Filter by metode
    public function scopeByMetode($query, $metode)
    {
        return $query->where('metode', $metode);
    }

    // Scope: Filter by bulan & tahun
    public function scopeByBulan($query, $bulan, $tahun)
    {
        return $query->whereMonth('tanggal', $bulan)
                     ->whereYear('tanggal', $tahun);
    }
}