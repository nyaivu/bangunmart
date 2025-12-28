@extends('layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')
<div class="max-w-xl mx-auto">
    <a href="{{ route('pelanggan.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium mb-4 inline-block">
        &larr; Kembali ke Daftar Pelanggan
    </a>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b bg-slate-50/50">
            <h2 class="text-xl font-bold text-slate-800">Edit Pelanggan #{{ $pelanggan->id_pelanggan }}</h2>
        </div>

        <form action="{{ route('pelanggan.update', $pelanggan->id_pelanggan) }}" method="POST" class="p-8 space-y-6">
            @csrf 
            @method('PUT')

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}" 
                       class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none" required>
                @error('nama_pelanggan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">No. HP (WhatsApp)</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $pelanggan->no_hp) }}" 
                       class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none" 
                       placeholder="Contoh: 08123456789">
                @error('no_hp') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Tipe</label>
                <select name="tipe" class="w-full px-4 py-2.5 border border-slate-300 rounded-xl outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="umum" {{ old('tipe', $pelanggan->tipe) == 'umum' ? 'selected' : '' }}>Umum</option>
                    <option value="member" {{ old('tipe', $pelanggan->tipe) == 'member' ? 'selected' : '' }}>Member</option>
                    <option value="proyek" {{ old('tipe', $pelanggan->tipe) == 'proyek' ? 'selected' : '' }}>Proyek</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Kota</label>
                <input type="text" name="kota" value="{{ old('kota', $pelanggan->kota) }}" 
                       class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                @error('kota') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end space-x-3 pt-4 border-t">
                <a href="{{ route('pelanggan.index') }}" class="px-6 py-2.5 font-bold text-slate-500 hover:text-slate-700">Batal</a>
                <button type="submit" class="bg-blue-600 text-white px-8 py-2.5 rounded-xl font-bold hover:bg-blue-700 shadow-md transition-all active:scale-95">
                    Update Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection