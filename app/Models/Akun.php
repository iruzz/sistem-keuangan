<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    protected $table = 'akun';
    
    protected $fillable = [
        'kode_akun',
        'nama_akun',
        'jenis',
        'saldo_awal',
    ];

    public $timestamps = true;

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'kode_akun';
    }
}
