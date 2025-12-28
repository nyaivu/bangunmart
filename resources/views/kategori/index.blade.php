@extends('layouts.app')

@section('title', 'Manajemen Kategori')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Kategori Produk</h2>
        <p class="text-slate-500 text-sm">Kelola pengelompokan material bangunan.</p>
    </div>
    <button onclick="document.getElementById('modalAdd').classList.remove('hidden')" 
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition-all">
        + Tambah Kategori
    </button>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500">ID</th>
                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500">Nama Kategori</th>
                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach($kategori as $k)
            <tr class="hover:bg-slate-50 transition-colors">
                <td class="px-6 py-4 text-slate-600 font-mono text-sm">#{{ $k->id_kategori }}</td>
                <td class="px-6 py-4 font-semibold text-slate-700">{{ $k->nama_kategori }}</td>
                <td class="px-6 py-4 text-right space-x-2">
                    <a href="{{ route('kategori.edit', $k->id_kategori) }}" 
                    class="inline-flex items-center px-3 py-1.5 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded-lg text-sm font-bold transition-all">
                        Edit
                    </a>

                    <form action="{{ route('kategori.destroy', $k->id_kategori) }}" method="POST" class="inline">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg text-sm font-bold transition-all" 
                                onclick="return confirm('Hapus kategori ini? Produk dengan kategori ini mungkin akan terpengaruh.')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="modalAdd" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl w-full max-w-md shadow-2xl">
        <div class="p-6 border-b border-slate-100 flex justify-between">
            <h3 class="text-xl font-bold">Tambah Kategori</h3>
            <button onclick="document.getElementById('modalAdd').classList.add('hidden')" class="text-slate-400">&times;</button>
        </div>
        <form action="{{ route('kategori.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Kategori</label>
                <input type="text" name="nama_kategori" required maxlength="60"
                       class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg font-bold hover:bg-blue-700">Simpan Data</button>
        </form>
    </div>
</div>
@endsection