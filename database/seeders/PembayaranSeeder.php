<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembayaranSeeder extends Seeder {
    public function run(): void {
        DB::table('pembayaran')->insert([
            // Nota 1: (5*65rb) + (1*215rb) = 540.000
            ['id_nota' => 1, 'metode' => 'cash', 'jumlah_tagihan' => 540000, 'jumlah_bayar' => 600000, 'kembalian' => 60000, 'status_bayar' => 'berhasil'],
            // Nota 2: (10*85rb) + (4*25rb) = 950.000
            ['id_nota' => 2, 'metode' => 'transfer', 'jumlah_tagihan' => 950000, 'jumlah_bayar' => 950000, 'kembalian' => 0, 'status_bayar' => 'berhasil'],
            // Nota 3: (2*950rb) = 1.900.000
            ['id_nota' => 3, 'metode' => 'qris', 'jumlah_tagihan' => 1900000, 'jumlah_bayar' => 1900000, 'kembalian' => 0, 'status_bayar' => 'berhasil'],
        ]);
    }
}