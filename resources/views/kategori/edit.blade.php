@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="max-w-2xl mx-auto">
    <a href="{{ route('kategori.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium mb-4 inline-block">
        &larr; Kembali ke Daftar Kategori
    </a>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-100 bg-slate-50/50">
            <h2 class="text-xl font-bold text-slate-800">Edit Kategori Produk</h2>
            <p class="text-slate-500 text-sm">Ubah informasi kategori untuk #{{ $kategori->id_kategori }}</p>
        </div>

        <form action="{{ route('kategori.update', $kategori->id_kategori) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT') {{-- Wajib menggunakan PUT/PATCH untuk update di Laravel --}}

            <div>
                <label for="nama_kategori" class="block text-sm font-semibold text-slate-700 mb-2">
                    Nama Kategori
                </label>
                <input type="text" 
                       name="nama_kategori" 
                       id="nama_kategori"
                       value="{{ old('nama_kategori', $kategori->nama_kategori) }}" 
                       class="w-full px-4 py-2.5 border @error('nama_kategori') border-red-500 @else border-slate-300 @enderror rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                       placeholder="Contoh: Semen & Mortar"
                       required>
                
                @error('nama_kategori')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-slate-100">
                <a href="{{ route('kategori.index') }}" 
                   class="px-4 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-100 rounded-xl transition-all">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-md hover:shadow-lg transition-all active:scale-95">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection