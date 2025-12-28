<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Satuan;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        // 1. Inisialisasi query dengan Eager Loading
        $query = Produk::with(['kategori', 'satuan']);

        // 2. Filter berdasarkan Nama Produk atau Barcode
        $query->when($request->search, function ($q) use ($request) {
            return $q->where('nama_produk', 'like', '%' . $request->search . '%')
                    ->orWhere('barcode', 'like', '%' . $request->search . '%');
        });

        // 3. Filter berdasarkan Kategori
        $query->when($request->id_kategori, function ($q) use ($request) {
            return $q->where('id_kategori', $request->id_kategori);
        });

        // 4. Filter khusus "Stok Menipis" (Requirement #5 & #14)
        $query->when($request->filter_stok == 'menipis', function ($q) {
            return $q->whereColumn('stok', '<=', 'stok_minimum');
        });

        $produk = $query->get();
        $kategori = Kategori::all(); // Untuk dropdown filter

        return view('produk.index', compact('produk', 'kategori'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        $satuan = Satuan::all();
        return view('produk.create', compact('kategori', 'satuan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|max:150',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'id_satuan'   => 'required|exists:satuan,id_satuan',
            'barcode'     => 'required|unique:produk,barcode',
            'harga_jual'  => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'stok_minimum'        => 'required|integer|min:0',
        ]);

        Produk::create($request->all());
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::all();
        $satuan = Satuan::all();
        return view('produk.edit', compact('produk', 'kategori', 'satuan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|max:150',
            'id_kategori' => 'required',
            'id_satuan' => 'required',
            'barcode' => 'required|unique:produk,barcode,'.$id.',id_produk',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer',
            'stok_minimum' => 'required|integer', // Pastikan ini divalidasi
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update($request->all());

        return redirect()->route('produk.index')->with('success', 'Data produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Produk::destroy($id);
        return redirect()->back()->with('success', 'Produk dihapus.');
    }
}