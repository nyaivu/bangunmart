<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $table = 'detail_penjualan';
    public $timestamps = false;
    public $incrementing = false; // Karena Primary Key Gabungan
    protected $primaryKey = ['id_nota', 'id_produk']; // Info untuk dokumentasi

    protected $fillable = ['id_nota', 'id_produk', 'qty', 'harga_satuan', 'diskon_item'];

    public function produk() {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}