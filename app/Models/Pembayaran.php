<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model {
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_bayar';
    public $timestamps = false;
    protected $fillable = ['id_nota', 'metode', 'jumlah_tagihan', 'jumlah_bayar', 'kembalian', 'status_bayar'];
}
