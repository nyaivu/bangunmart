<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::orderBy('id_pelanggan', 'desc')->get();
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|max:100',
            'no_hp'          => 'nullable|max:20', // Sesuai PDF
            'tipe'           => 'required|in:umum,member,proyek',
            'kota'           => 'nullable|max:60'
        ]);

        Pelanggan::create($request->all());
        return redirect()->back()->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required|max:100',
            'no_hp'          => 'nullable|max:20', // Sesuai PDF
            'tipe'           => 'required|in:umum,member,proyek',
            'kota'           => 'nullable|max:60'
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan diperbarui.');
    }

    public function destroy($id)
    {
        Pelanggan::destroy($id);
        return redirect()->back()->with('success', 'Pelanggan berhasil dihapus.');
    }
}