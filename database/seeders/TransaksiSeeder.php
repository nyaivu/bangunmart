<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder {
    public function run(): void {
        // Nota 1: Pembelian Semen & Cat
        $id1 = DB::table('penjualan')->insertGetId([
            'id_pegawai' => 1, 'id_pelanggan' => 1, 'status_nota' => 'dibayar', 'tgl_nota' => '2025-12-01 10:00:00'
        ]);
        DB::table('detail_penjualan')->insert([
            ['id_nota' => $id1, 'id_produk' => 1, 'qty' => 5, 'harga_satuan' => 65000], // Semen
            ['id_nota' => $id1, 'id_produk' => 2, 'qty' => 1, 'harga_satuan' => 215000] // Cat
        ]);

        // Nota 2: Pembelian Besi & Pipa
        $id2 = DB::table('penjualan')->insertGetId([
            'id_pegawai' => 2, 'id_pelanggan' => 2, 'status_nota' => 'dibayar', 'tgl_nota' => '2025-12-01 11:30:00'
        ]);
        DB::table('detail_penjualan')->insert([
            ['id_nota' => $id2, 'id_produk' => 6, 'qty' => 10, 'harga_satuan' => 85000], // Besi
            ['id_nota' => $id2, 'id_produk' => 4, 'qty' => 4, 'harga_satuan' => 25000]  // Pipa
        ]);

        // Nota 3: Pembelian Tangki Air (Produk Terlaris)
        $id3 = DB::table('penjualan')->insertGetId([
            'id_pegawai' => 1, 'id_pelanggan' => 3, 'status_nota' => 'dibayar', 'tgl_nota' => '2025-12-02 09:15:00'
        ]);
        DB::table('detail_penjualan')->insert([
            ['id_nota' => $id3, 'id_produk' => 10, 'qty' => 2, 'harga_satuan' => 950000] // Tangki
        ]);
    }
}