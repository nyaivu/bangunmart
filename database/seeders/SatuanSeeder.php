<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void {
    $data = ['Kotak', 'Botol', 'Pcs', 'Sachet', 'Kilogram', 'Liter', 'Pack', 'Unit', 'Meter', 'Ikat'];
    foreach ($data as $item) {
        DB::table('satuan')->insert(['nama_satuan' => $item]);
    }
}
}
