<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Penjualan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data produk dengan stok menipis (Requirement #14)
        $stokMenipis = Produk::with(['kategori', 'satuan'])
            ->whereColumn('stok', '<=', 'stok_minimum')
            ->get();

        // 2. Ringkasan Statistik untuk Admin
        $totalProduk = Produk::count();
        $totalPenjualanHariIni = Penjualan::whereDate('tgl_nota', today())->count();
        
        // 3. Produk Terlaris (Requirement #13)
        $produkTerlaris = DB::table('detail_penjualan')
            ->join('produk', 'detail_penjualan.id_produk', '=', 'produk.id_produk')
            ->select('produk.nama_produk', DB::raw('SUM(qty) as total_qty'))
            ->groupBy('produk.id_produk', 'produk.nama_produk')
            ->orderBy('total_qty', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact('stokMenipis', 'totalProduk', 'totalPenjualanHariIni', 'produkTerlaris'));
    }
}