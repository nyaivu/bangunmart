@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-100 bg-slate-50/50">
            <h2 class="text-xl font-bold">Input Produk Baru</h2>
        </div>

        <form action="{{ route('produk.store') }}" method="POST" class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold mb-1">Nama Produk</label>
                <input type="text" name="nama_produk" class="w-full px-4 py-2 border border-slate-300 rounded-xl" required>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Kategori</label>
                <select name="id_kategori" class="w-full px-4 py-2 border border-slate-300 rounded-xl" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Satuan</label>
                <select name="id_satuan" class="w-full px-4 py-2 border border-slate-300 rounded-xl" required>
                    @foreach($satuan as $s)
                        <option value="{{ $s->id_satuan }}">{{ $s->nama_satuan }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Barcode</label>
                <input type="text" name="barcode" class="w-full px-4 py-2 border border-slate-300 rounded-xl" required>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Harga Jual</label>
                <input type="number" name="harga_jual" class="w-full px-4 py-2 border border-slate-300 rounded-xl" required>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Stok Awal</label>
                <input type="number" name="stok" class="w-full px-4 py-2 border border-slate-300 rounded-xl" required>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1 text-red-700">Stok Minimum (Peringatan)</label>
                <input type="number" name="stok_minimum" value="{{ old('stok_minimum', $produk->stok_minimum ?? 0) }}" 
                    class="w-full px-4 py-2 border border-red-200 rounded-xl focus:ring-2 focus:ring-red-500 outline-none" 
                    placeholder="Contoh: 10" required>
                <p class="mt-1 text-[10px] text-slate-500 italic">*Sistem akan memberi peringatan jika stok di bawah angka ini.</p>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Rak</label>
                <input type="text" name="rak" placeholder="Contoh: A1" class="w-full px-4 py-2 border border-slate-300 rounded-xl">
            </div>

            <div class="md:col-span-2 pt-4 border-t flex justify-end space-x-3">
                <a href="{{ route('produk.index') }}" class="px-6 py-2 text-slate-600 font-semibold">Batal</a>
                <button type="submit" class="bg-blue-600 text-white px-8 py-2 rounded-xl font-bold shadow-md hover:bg-blue-700 transition-all">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection