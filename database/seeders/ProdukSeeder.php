<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
    $products = [
        ['nama' => 'Semen Tiga Roda 50kg', 'harga' => 65000, 'kat' => 1],
        ['nama' => 'Cat Mowilex Emulsion White 5L', 'harga' => 215000, 'kat' => 2],
        ['nama' => 'Paku Beton 5cm (Per Kotak)', 'harga' => 35000, 'kat' => 3],
        ['nama' => 'Pipa PVC Rucika 1/2 Inch', 'harga' => 25000, 'kat' => 4],
        ['nama' => 'Keramik Arwana 40x40 Putih', 'harga' => 55000, 'kat' => 5],
        ['nama' => 'Besi Beton 10mm SNI', 'harga' => 85000, 'kat' => 6],
        ['nama' => 'Kayu Meranti 4x6 (Per Batang)', 'harga' => 45000, 'kat' => 7],
        ['nama' => 'Gypsum Jayaboard 9mm', 'harga' => 95000, 'kat' => 8],
        ['nama' => 'Seng Gelombang Gajah', 'harga' => 60000, 'kat' => 9],
        ['nama' => 'Tangki Air Profil Tank 500L', 'harga' => 950000, 'kat' => 10]
    ];

    foreach ($products as $i => $p) {
        DB::table('produk')->insert([
            'id_kategori' => $p['kat'],
            'id_satuan' => rand(1, 5),
            'barcode' => '899' . rand(1000000000, 9999999999),
            'nama_produk' => $p['nama'],
            'harga_jual' => $p['harga'],
            'stok' => rand(20, 100),
            'stok_minimum' => 10,
            'rak' => 'Gudang-' . chr(rand(65, 70)) . rand(1, 5),
            'status' => 'aktif'
        ]);
    }
}
}
