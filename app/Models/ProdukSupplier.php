<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukSupplier extends Model {
    protected $table = 'produk_supplier';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['id_produk', 'id_supplier', 'harga_beli_terakhir'];
}
