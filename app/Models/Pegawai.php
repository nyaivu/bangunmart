<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pegawai extends Authenticatable
{
    use Notifiable;

    protected $table = 'pegawai';
    protected $primaryKey = 'id_pegawai';
    public $timestamps = false;

    protected $fillable = [
        'nama_pegawai', 
        'jabatan', 
        'shift', 
        'password', // Pastikan kolom ini ada di migrasi
        'aktif'
    ];

    protected $hidden = ['password'];

    // Helper untuk cek role di Blade/Controller
    public function isAdmin() {
        return $this->jabatan === 'admin';
    }

    public function isKasir() {
        return $this->jabatan === 'kasir';
    }
}