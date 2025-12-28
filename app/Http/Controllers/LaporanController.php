<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\DetailPenjualan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{

    public function index()
    {
        // Mengambil ringkasan data untuk ditampilkan di dashboard laporan
        $totalStokMenipis = Produk::whereColumn('stok', '<=', 'stok_minimum')->count();
        $omzetHariIni = DB::table('pembayaran')
            ->whereDate('tgl_bayar', date('Y-m-d'))
            ->sum('jumlah_tagihan');

        return view('laporan.index', compact('totalStokMenipis', 'omzetHariIni'));
    }

    public function penjualan(Request $request)
    {
        $tgl_mulai = $request->get('tgl_mulai', date('Y-m-01'));
        $tgl_selesai = $request->get('tgl_selesai', date('Y-m-d'));

        $laporan = DB::table('pembayaran')
            ->join('penjualan', 'pembayaran.id_nota', '=', 'penjualan.id_nota')
            ->select('penjualan.tgl_nota', 'pembayaran.metode', 'pembayaran.jumlah_tagihan')
            ->whereBetween(DB::raw('DATE(penjualan.tgl_nota)'), [$tgl_mulai, $tgl_selesai])
            ->where('penjualan.status_nota', 'dibayar')
            ->orderBy('penjualan.tgl_nota', 'desc')
            ->get();

        $total_omzet = $laporan->sum('jumlah_tagihan');

        return view('laporan.penjualan', compact('laporan', 'total_omzet', 'tgl_mulai', 'tgl_selesai'));
    }

    // 13. Laporan Produk Terlaris
    public function terlaris()
    {
        $terlaris = DetailPenjualan::with('produk')
            ->select('id_produk', DB::raw('SUM(qty) as total_terjual'))
            ->groupBy('id_produk')
            ->orderBy('total_terjual', 'desc')
            ->take(10)
            ->get();

        return view('laporan.terlaris', compact('terlaris'));
    }

    // 14. Laporan Stok Menipis
    public function stokMenipis()
    {
        // Mengambil produk yang stoknya di bawah stok_minimum (sesuai PDF)
        $produk = Produk::whereColumn('stok', '<=', 'stok_minimum')
            ->orderBy('stok', 'asc')
            ->get();

        return view('laporan.stok_menipis', compact('produk'));
    }

    public function cetakPenjualan(Request $request)
    {
        $tgl_mulai = $request->get('tgl_mulai', date('Y-m-01'));
        $tgl_selesai = $request->get('tgl_selesai', date('Y-m-d'));

        $laporan = DB::table('pembayaran')
            ->join('penjualan', 'pembayaran.id_nota', '=', 'penjualan.id_nota')
            ->select('penjualan.tgl_nota', 'pembayaran.metode', 'pembayaran.jumlah_tagihan')
            ->whereBetween(DB::raw('DATE(penjualan.tgl_nota)'), [$tgl_mulai, $tgl_selesai])
            ->where('penjualan.status_nota', 'dibayar')
            ->get();

        $total_omzet = $laporan->sum('jumlah_tagihan');

        // Load view khusus untuk PDF
        $pdf = Pdf::loadView('laporan.pdf_penjualan', compact('laporan', 'total_omzet', 'tgl_mulai', 'tgl_selesai'));
        
        // Download atau Stream (tampil di browser)
        return $pdf->stream('laporan-penjualan.pdf');
    }
}