<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    public function index()
    {
        $satuan = Satuan::all();
        return view('satuan.index', compact('satuan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_satuan' => 'required|max:20|unique:satuan,nama_satuan'
        ]);

        Satuan::create($request->all());
        return redirect()->back()->with('success', 'Satuan baru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $satuan = Satuan::findOrFail($id);
        return view('satuan.edit', compact('satuan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_satuan' => 'required|max:20|unique:satuan,nama_satuan,'.$id.',id_satuan'
        ]);

        $satuan = Satuan::findOrFail($id);
        $satuan->update($request->all());

        return redirect()->route('satuan.index')->with('success', 'Satuan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            Satuan::destroy($id);
            return redirect()->back()->with('success', 'Satuan berhasil dihapus.');
        } catch (\Exception $e) {
            // Error handling jika satuan masih dipakai oleh produk (Foreign Key Constraint)
            return redirect()->back()->with('error', 'Gagal menghapus! Satuan ini masih digunakan oleh data produk.');
        }
    }
}