<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pegawai;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PegawaiSeeder extends Seeder
{
    public function run(): void
    {
        // Mendaftarkan Admin
        Pegawai::create([
            'nama_pegawai' => 'Admin Utama',
            'jabatan' => 'admin',
            'shift' => 'pagi',
            'password' => Hash::make('admin123'), // Wajib menggunakan Hash
            'aktif' => 1
        ]);

        // Mendaftarkan Kasir
        Pegawai::create([
            'nama_pegawai' => 'Kasir Budi',
            'jabatan' => 'kasir',
            'shift' => 'siang',
            'password' => Hash::make('kasir123'),
            'aktif' => 1
        ]);

        $jabatan = ['kasir', 'gudang', 'admin'];
        $shift = ['pagi', 'siang', 'malam'];
        for ($i = 1; $i <= 10; $i++) {
            DB::table('pegawai')->insert([
                'nama_pegawai' => "Staf $i",
                'password' => bcrypt('password123'),
                'jabatan' => $jabatan[array_rand($jabatan)],
                'shift' => $shift[array_rand($shift)],
                'aktif' => 1
            ]);
        }
    }
}