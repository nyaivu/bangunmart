@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('produk.index') }}" class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-800 mb-6 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Kembali ke Daftar Produk
    </a>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-8 border-b border-slate-100 bg-slate-50/50">
            <h2 class="text-2xl font-bold text-slate-800">Edit Produk</h2>
            <p class="text-slate-500">Perbarui informasi produk: <span class="text-slate-900 font-semibold">{{ $produk->nama_produk }}</span></p>
        </div>

        <form action="{{ route('produk.update', $produk->id_produk) }}" method="POST" class="p-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Produk</label>
                    <input type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" 
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Kategori</label>
                    <select name="id_kategori" class="w-full px-4 py-3 border border-slate-300 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 appearance-none bg-white">
                        @foreach($kategori as $k)
                            <option value="{{ $k->id_kategori }}" {{ $produk->id_kategori == $k->id_kategori ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Satuan</label>
                    <select name="id_satuan" class="w-full px-4 py-3 border border-slate-300 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 appearance-none bg-white">
                        @foreach($satuan as $s)
                            <option value="{{ $s->id_satuan }}" {{ $produk->id_satuan == $s->id_satuan ? 'selected' : '' }}>
                                {{ $s->nama_satuan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Barcode</label>
                    <input type="text" name="barcode" value="{{ old('barcode', $produk->barcode) }}" 
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Harga Jual (Rp)</label>
                    <input type="number" name="harga_jual" value="{{ old('harga_jual', $produk->harga_jual) }}" 
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Stok Saat Ini</label>
                    <input type="number" name="stok" value="{{ old('stok', $produk->stok) }}" 
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-red-700 mb-2">Stok Minimum (Alert)</label>
                    <input type="number" name="stok_minimum" value="{{ old('stok_minimum', $produk->stok_minimum) }}" 
                           class="w-full px-4 py-3 border border-red-200 bg-red-50/30 rounded-xl focus:ring-2 focus:ring-red-500 outline-none transition-all" required>
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Lokasi Rak (Opsional)</label>
                    <input type="text" name="rak" value="{{ old('rak', $produk->rak) }}" 
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all" placeholder="Contoh: Rak Besi A-1">
                </div>
            </div>

            <div class="mt-10 pt-6 border-t border-slate-100 flex justify-end space-x-4">
                <a href="{{ route('produk.index') }}" class="px-6 py-3 font-bold text-slate-500 hover:text-slate-700 transition-colors">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-3 rounded-xl font-bold shadow-lg shadow-blue-200 transition-all active:scale-95">
                    Update Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection