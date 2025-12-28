<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualan';
    protected $primaryKey = 'id_nota'; 
    public $timestamps = false;

    protected $fillable = [
        'tgl_nota', 
        'id_pegawai', 
        'id_pelanggan', 
        'diskon_nota',
        'status_nota' 
    ];

// Relasi ke tabel detail_penjualan
    public function detail()
    {
        return $this->hasMany(DetailPenjualan::class, 'id_nota', 'id_nota');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_nota', 'id_nota');
    }

    // Relasi ke tabel pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    // Relasi ke tabel pegawai
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }
}

