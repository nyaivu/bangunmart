<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\Produk;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    // 8. /penjualan (List Nota)
    public function index()
    {
        $penjualan = Penjualan::with(['pelanggan', 'pegawai'])->orderBy('tgl_nota', 'desc')->get();
        return view('penjualan.index', compact('penjualan'));
    }

    // 9. /penjualan/create (Form Buat Nota)
    public function create()
    {
        $produk = Produk::where('stok', '>', 0)->get();
        $pelanggan = Pelanggan::all();
        return view('penjualan.create', compact('produk', 'pelanggan'));
    }

    // Logic Menyimpan Transaksi (TCL Implementation)
    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|array',
            'qty' => 'required|array',
        ]);

        // MENGGUNAKAN DATABASE TRANSACTION (TCL)
        DB::beginTransaction();

        try {
            // 1. Simpan Header Penjualan
            $penjualan = new Penjualan();
            $penjualan->tgl_nota = now();
            $penjualan->id_pegawai = Auth::id();
            $penjualan->id_pelanggan = $request->id_pelanggan;
            $penjualan->status_nota = 'baru';
            $penjualan->save();

            // 2. Simpan Detail & Update Stok
            foreach ($request->id_produk as $index => $id_produk) {
                $qty_beli = $request->qty[$index];
                $produk = Produk::lockForUpdate()->find($id_produk);

                // Cek Stok Kembali (Concurrency Guard)
                if ($produk->stok < $qty_beli) {
                    throw new \Exception("Stok {$produk->nama_produk} tidak mencukupi!");
                }

                // Simpan ke Detail Penjualan
                DetailPenjualan::create([
                    'id_nota' => $penjualan->id_nota,
                    'id_produk' => $id_produk,
                    'qty' => $qty_beli,
                    'harga_satuan' => $produk->harga_jual,
                    'diskon_item' => 0
                ]);

                // Update Stok Produk
                $produk->decrement('stok', $qty_beli);
            }

            DB::commit(); // Simpan permanen
            return redirect()->route('penjualan.show', $penjualan->id_nota)->with('success', 'Transaksi Berhasil!');

        } catch (\Exception $e) {
            DB::rollback(); // Batalkan semua jika ada error
            return redirect()->back()->with('error', 'Transaksi Gagal: ' . $e->getMessage());
        }
    }

    // 10. /penjualan/{id} (Detail Nota + Item)
    public function show($id)
    {
        $nota = Penjualan::with(['detail.produk', 'pelanggan', 'pegawai', 'pembayaran'])->findOrFail($id);
        return view('penjualan.show', compact('nota'));
    }

    // Menampilkan form pembayaran
public function pembayaran($id_nota)
{
    $nota = Penjualan::with('detail.produk')->findOrFail($id_nota);
    
    // Hitung total belanja
    $total = $nota->detail->sum(function($d) {
        return $d->qty * $d->harga_satuan;
    });

    return view('penjualan.pembayaran', compact('nota', 'total'));
}

// Menyimpan data pembayaran (TCL)
public function prosesPembayaran(Request $request, $id_nota)
{
    $request->validate([
        'tgl_bayar' => 'required|date',
        'bayar' => 'required|numeric',
        'metode' => 'required|in:cash,qris,debit'
    ]);

    DB::beginTransaction();
    try {
        $nota = Penjualan::findOrFail($id_nota);
        $total = $request->total_belanja;
        $bayar = $request->bayar;

        if ($bayar < $total) {
            return redirect()->back()->with('error', 'Uang pembayaran kurang!');
        }

        DB::table('pembayaran')->insert([
            'id_nota'        => $id_nota,
            'metode'         => $request->metode,
            'jumlah_tagihan' => $total,          
            'jumlah_bayar'   => $bayar,          
            'kembalian'      => $bayar - $total, 
            'tgl_bayar'      => now(),           
            'status_bayar'   => 'berhasil'       
        ]);

        // 2. Update status nota menjadi dibayar
        $nota->update(['status_nota' => 'dibayar']);

        DB::commit();
        return redirect()->route('penjualan.show', $id_nota)->with('success', 'Pembayaran Berhasil!');
        } catch (\Exception $e) {
            DB::rollback();
            // Paksa tampilkan error jika gagal di level database
            dd($e->getMessage());
        }
}
}