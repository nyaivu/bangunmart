<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('kategori.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate(['nama_kategori' => 'required|max:60']);
        Kategori::create($request->all());
        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|max:60'
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        try {
            Kategori::destroy($id);
            return redirect()->back()->with('success', 'Kategori dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus! Kategori mungkin masih digunakan oleh produk.');
        }
    }
}