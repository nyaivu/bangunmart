<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
    $categories = [
        'Semen & Mortar',
        'Cat & Perlengkapan',
        'Besi & Logam',
        'Pipa & Plumbing',
        'Keramik & Granit',
        'Kayu & Papan',
        'Atap & Plafon',
        'Paku & Baut',
        'Alat Pertukangan',
        'Sanitari & Kamar Mandi'
    ];

    foreach ($categories as $nama) {
        DB::table('kategori')->insert([
            'nama_kategori' => $nama
        ]);
    }
}
}
