<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $pelanggan = [
            ['nama' => 'Budi Santoso', 'tipe' => 'umum', 'kota' => 'Palangka Raya'],
            ['nama' => 'CV Maju Jaya Konstruksi', 'tipe' => 'proyek', 'kota' => 'Banjarmasin'],
            ['nama' => 'Andi Wijaya', 'tipe' => 'member', 'kota' => 'Palangka Raya'],
            ['nama' => 'PT Bangun Rumah Sejahtera', 'tipe' => 'proyek', 'kota' => 'Sampit'],
            ['nama' => 'Siti Aminah', 'tipe' => 'umum', 'kota' => 'Palangka Raya'],
            ['nama' => 'Haji Mansyur', 'tipe' => 'member', 'kota' => 'Kuala Kapuas'],
            ['nama' => 'Dekor Interior Mandiri', 'tipe' => 'proyek', 'kota' => 'Palangka Raya'],
            ['nama' => 'Rizky Pratama', 'tipe' => 'umum', 'kota' => 'Palangka Raya'],
            ['nama' => 'Member Setia BangunMart', 'tipe' => 'member', 'kota' => 'Palangka Raya'],
            ['nama' => 'Toko Besi Berkah', 'tipe' => 'umum', 'kota' => 'Pangkalan Bun']
        ];

        foreach ($pelanggan as $p) {
            DB::table('pelanggan')->insert([
                'nama_pelanggan' => $p['nama'],
                'no_hp' => '0852' . rand(10000000, 99999999),
                'tipe' => $p['tipe'],
                'kota' => $p['kota'],
                'tgl_daftar' => now()
            ]);
        }
    }
}
