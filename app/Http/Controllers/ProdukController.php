<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Satuan;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        // Tambahkan 'suppliers' ke dalam with()
        $query = Produk::with(['kategori', 'satuan', 'suppliers']);

        // Filter Nama/Barcode
        $query->when($request->search, function ($q) use ($request) {
            return $q->where('nama_produk', 'like', '%' . $request->search . '%')
                    ->orWhere('barcode', 'like', '%' . $request->search . '%');
        });

        // Filter Kategori
        $query->when($request->id_kategori, function ($q) use ($request) {
            return $q->where('id_kategori', $request->id_kategori);
        });

        // BARU: Filter berdasarkan Supplier
        $query->when($request->id_supplier, function ($q) use ($request) {
            return $q->whereHas('suppliers', function($s) use ($request) {
                $s->where('supplier.id_supplier', $request->id_supplier);
            });
        });

        $query->when($request->filter_stok == 'menipis', function ($q) {
            return $q->whereColumn('stok', '<=', 'stok_minimum');
        });

        $produk = $query->get();
        $kategori = Kategori::all();
        $suppliers = Supplier::all(); // Ambil semua data supplier untuk dropdown filter

        return view('produk.index', compact('produk', 'kategori', 'suppliers'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        $suppliers = Supplier::all();
        $satuan = Satuan::all();
        return view('produk.create', compact('kategori', 'satuan', 'suppliers'));
    }

    public function store(Request $request) {
        // Memulai Transaksi (TCL)
        DB::beginTransaction();

        try {
            // 1. Simpan data ke tabel Produk
            $produkId = DB::table('produk')->insertGetId([
                'id_kategori' => $request->id_kategori,
                'id_satuan'   => $request->id_satuan,
                'nama_produk' => $request->nama_produk,
                'barcode'     => $request->barcode,
                'harga_jual'  => $request->harga_jual,
                'stok'        => $request->stok,
                'stok_minimum'=> $request->stok_minimum,
                'rak'         => $request->rak,
                'status'      => 'aktif'
            ]);

            // 2. Simpan relasi ke tabel Produk_Supplier (Referensi Supplier ke Produk)
            DB::table('produk_supplier')->insert([
                'id_produk'           => $produkId,
                'id_supplier'         => $request->id_supplier,
                'harga_beli_terakhir' => $request->harga_beli
            ]);

            // Jika semua berhasil, simpan permanen
            DB::commit();
            return redirect()->route('produk.index')->with('success', 'Produk & Supplier berhasil ditambahkan!');

        } catch (\Exception $e) {
            // Jika ada satu saja yang gagal, batalkan semua perubahan
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::all();
        $satuan = Satuan::all();
        $suppliers = Supplier::all();
        return view('produk.edit', compact('produk', 'kategori', 'satuan', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|max:150',
            'id_kategori' => 'required',
            'id_supplier' => 'required',
            'harga_beli'  => 'required|numeric',
            // Barcode unik kecuali untuk ID produk ini sendiri
            'barcode'     => 'required|unique:produk,barcode,'.$id.',id_produk',
        ]);

        DB::beginTransaction();
        try {
            $produk = Produk::findOrFail($id);
            
            // 1. Update data utama di tabel Produk
            $produk->update([
                'id_kategori' => $request->id_kategori,
                'id_satuan'   => $request->id_satuan,
                'nama_produk' => $request->nama_produk,
                'barcode'     => $request->barcode,
                'harga_jual'  => $request->harga_jual,
                'stok'        => $request->stok,
                'stok_minimum'=> $request->stok_minimum,
                'rak'         => $request->rak,
            ]);

            // 2. Update atau Buat Relasi di tabel Produk_Supplier (Pivot)
            // sync() akan menghapus relasi lama dan menggantinya dengan yang baru
            $produk->suppliers()->sync([
                $request->id_supplier => ['harga_beli_terakhir' => $request->harga_beli]
            ]);

            DB::commit();
            return redirect()->route('produk.index')->with('success', 'Data produk dan supplier berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        Produk::destroy($id);
        return redirect()->back()->with('success', 'Produk dihapus.');
    }
}