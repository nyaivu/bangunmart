@extends('layouts.app')

@section('title', 'Manajemen Supplier')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-slate-800">Daftar Supplier</h2>
    <button onclick="document.getElementById('modalSupplier').classList.remove('hidden')" 
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-bold shadow-md">
        + Tambah Supplier
    </button>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-slate-50 border-b">
            <tr>
                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500">Nama Supplier</th>
                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500">No. HP</th>
                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500">Kota</th>
                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @foreach($supplier as $s)
            <tr class="hover:bg-slate-50">
                <td class="px-6 py-4 font-bold text-slate-700">{{ $s->nama_supplier }}</td>
                <td class="px-6 py-4 text-slate-600">{{ $s->no_hp ?? '-' }}</td>
                <td class="px-6 py-4 text-slate-500">{{ $s->kota ?? '-' }}</td>
                <td class="px-6 py-4 text-right space-x-3">
                    <a href="{{ route('supplier.edit', $s->id_supplier) }}" class="text-blue-600 font-bold hover:underline">Edit</a>
                    <form action="{{ route('supplier.destroy', $s->id_supplier) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 font-bold hover:underline" onclick="return confirm('Hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="modalSupplier" class="fixed inset-0 bg-slate-900/60 hidden flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-2xl w-full max-w-md shadow-2xl">
        <div class="p-6 border-b flex justify-between items-center">
            <h3 class="text-xl font-bold">Tambah Supplier</h3>
            <button onclick="document.getElementById('modalSupplier').classList.add('hidden')" class="text-slate-400 text-2xl">&times;</button>
        </div>
        <form action="{{ route('supplier.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold mb-1">Nama Supplier</label>
                <input type="text" name="nama_supplier" class="w-full px-4 py-2 border rounded-xl" required>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">No. HP</label>
                <input type="text" name="no_hp" class="w-full px-4 py-2 border rounded-xl">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Kota</label>
                <input type="text" name="kota" class="w-full px-4 py-2 border rounded-xl">
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700">Simpan Supplier</button>
        </form>
    </div>
</div>
@endsection