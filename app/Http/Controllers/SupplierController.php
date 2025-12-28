<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $supplier = Supplier::all();
        return view('supplier.index', compact('supplier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required|max:120',
            'no_hp'          => 'nullable|max:20',
            'kota'           => 'nullable|max:60'
        ]);

        Supplier::create($request->all());
        return redirect()->back()->with('success', 'Supplier berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_supplier' => 'required|max:120',
            'no_hp'          => 'nullable|max:20',
            'kota'           => 'nullable|max:60'
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all());

        return redirect()->route('supplier.index')->with('success', 'Data supplier diperbarui.');
    }

    public function destroy($id)
    {
        Supplier::destroy($id);
        return redirect()->back()->with('success', 'Supplier berhasil dihapus.');
    }
}