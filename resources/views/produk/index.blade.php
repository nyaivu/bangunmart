@extends('layouts.app')

@section('title', 'Manajemen Produk')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-slate-800">Daftar Produk</h2>
    <a href="{{ route('produk.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-xl font-bold hover:bg-blue-700 transition-all">
        + Produk Baru
    </a>
</div>

<div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 mb-6">
    <form action="{{ route('produk.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
        <div>
            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Cari Produk</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama atau Barcode..." 
                   class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Kategori</label>
            <select name="id_kategori" class="w-full px-4 py-2 border border-slate-300 rounded-xl outline-none">
                <option value="">Semua Kategori</option>
                @foreach($kategori as $k)
                    <option value="{{ $k->id_kategori }}" {{ request('id_kategori') == $k->id_kategori ? 'selected' : '' }}>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Kondisi Stok</label>
            <select name="filter_stok" class="w-full px-4 py-2 border border-slate-300 rounded-xl outline-none">
                <option value="">Semua Stok</option>
                <option value="menipis" {{ request('filter_stok') == 'menipis' ? 'selected' : '' }}>🚨 Stok Menipis</option>
            </select>
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="flex-1 bg-slate-800 text-white py-2 rounded-xl font-bold hover:bg-slate-700">
                Filter
            </button>
            <a href="{{ route('produk.index') }}" class="flex-1 bg-slate-100 text-slate-600 py-2 rounded-xl font-bold text-center hover:bg-slate-200">
                Reset
            </a>
        </div>
    </form>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500">Info Produk</th>
                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500">Kategori</th>
                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500 text-right">Harga Jual</th>
                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500 text-center">Stok</th>
                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach($produk as $p)
            <tr class="hover:bg-slate-50/50 transition-colors">
                <td class="px-6 py-4">
                    <div class="font-bold text-slate-800">{{ $p->nama_produk }}</div>
                    <div class="text-xs font-mono text-slate-400">{{ $p->barcode }}</div>
                </td>
                <td class="px-6 py-4 text-sm text-slate-600">
                    {{ $p->kategori->nama_kategori }}
                </td>
                <td class="px-6 py-4 text-right font-semibold text-slate-700">
                    Rp {{ number_format($p->harga_jual, 0, ',', '.') }}
                </td>
                <td class="px-6 py-4 text-center">
                    <div class="flex flex-col items-center">
                        <span class="font-bold {{ $p->stok <= $p->stok_minimum ? 'text-red-600' : 'text-slate-700' }}">
                            {{ $p->stok }}
                        </span>
                        @if($p->stok <= $p->stok_minimum)
                            <span class="text-[9px] bg-red-100 text-red-700 px-2 py-0.5 rounded-full font-black uppercase tracking-tighter">
                                Limit
                            </span>
                        @endif
                    </div>
                </td>
                <td class="px-6 py-4">
                    <div class="flex justify-center space-x-2">
                        <a href="{{ route('produk.edit', $p->id_produk) }}" 
                           class="p-2 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg transition-colors group"
                           title="Edit Produk">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>

                        <form action="{{ route('produk.destroy', $p->id_produk) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="p-2 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg transition-colors"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"
                                    title="Hapus Produk">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection