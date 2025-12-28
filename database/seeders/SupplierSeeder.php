<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $suppliers = [
            ['nama' => 'PT Catur Sentosa Adiprana', 'kota' => 'Jakarta'],
            ['nama' => 'PT Surya Toto Indonesia', 'kota' => 'Tangerang'],
            ['nama' => 'PT Indocement Tunggal Prakarsa', 'kota' => 'Bogor'],
            ['nama' => 'PT Arwana Citramulia', 'kota' => 'Gresik'],
            ['nama' => 'PT Mowilex Indonesia', 'kota' => 'Jakarta'],
            ['nama' => 'PT Siam-Indo Gypsum', 'kota' => 'Bekasi'],
            ['nama' => 'PT Bakrie Pipe Industries', 'kota' => 'Bekasi'],
            ['nama' => 'PT Krakatau Steel', 'kota' => 'Cilegon'],
            ['nama' => 'PT Semen Indonesia', 'kota' => 'Gresik'],
            ['nama' => 'PT Djabesmen', 'kota' => 'Jakarta']
        ];

        foreach ($suppliers as $i => $s) {
            DB::table('supplier')->insert([
                'nama_supplier' => $s['nama'],
                'no_hp' => '0812' . rand(10000000, 99999999),
                'kota' => $s['kota']
            ]);
        }
    }
}
