<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    public $timestamps = false;

    protected $fillable = [
        'id_kategori', 'id_satuan', 'barcode', 'nama_produk', 
        'harga_jual', 'stok', 'stok_minimum', 'rak', 'status'
    ];

    public function kategori() {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function satuan() {
        return $this->belongsTo(Satuan::class, 'id_satuan');
    }

    // Relasi Many-to-Many ke Supplier
    public function suppliers() {
        return $this->belongsToMany(Supplier::class, 'produk_supplier', 'id_produk', 'id_supplier')
                    ->withPivot('harga_beli_terakhir');
    }
}