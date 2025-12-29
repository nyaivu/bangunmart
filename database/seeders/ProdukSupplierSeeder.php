<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pemetaan logis: id_produk => id_supplier
        // Disesuaikan dengan urutan data yang Anda buat di ProdukSeeder dan SupplierSeeder
        $relations = [
            ['id_produk' => 1,  'id_supplier' => 3,  'harga' => 60000],  // Semen -> Indocement
            ['id_produk' => 1,  'id_supplier' => 9,  'harga' => 59500],  // Semen -> Semen Indonesia
            ['id_produk' => 2,  'id_supplier' => 5,  'harga' => 195000], // Cat -> Mowilex
            ['id_produk' => 3,  'id_supplier' => 1,  'harga' => 28000],  // Paku -> Catur Sentosa
            ['id_produk' => 4,  'id_supplier' => 7,  'harga' => 21000],  // Pipa -> Bakrie Pipe
            ['id_produk' => 5,  'id_supplier' => 4,  'harga' => 48000],  // Keramik -> Arwana
            ['id_produk' => 6,  'id_supplier' => 8,  'harga' => 81000],  // Besi -> Krakatau Steel
            ['id_produk' => 7,  'id_supplier' => 1,  'harga' => 38000],  // Kayu -> Catur Sentosa
            ['id_produk' => 8,  'id_supplier' => 6,  'harga' => 88000],  // Gypsum -> Siam-Indo
            ['id_produk' => 9,  'id_supplier' => 10, 'harga' => 54000],  // Seng -> Djabesmen
            ['id_produk' => 10, 'id_supplier' => 1,  'harga' => 880000], // Tangki -> Catur Sentosa
        ];

        foreach ($relations as $rel) {
            DB::table('produk_supplier')->insert([
                'id_produk' => $rel['id_produk'],
                'id_supplier' => $rel['id_supplier'],
                'harga_beli_terakhir' => $rel['harga'],
            ]);
        }
    }
}