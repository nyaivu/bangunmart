@extends('layouts.app')

@section('title', 'Manajemen Satuan')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Satuan Barang</h2>
        <p class="text-slate-500 text-sm">Contoh: Pcs, Sak, Dus, Liter, Meter.</p>
    </div>
    <button onclick="document.getElementById('modalSatuan').classList.remove('hidden')" 
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-bold transition-all shadow-md">
        + Tambah Satuan
    </button>
</div>

@if(session('error'))
    <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
        {{ session('error') }}
    </div>
@endif

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500">ID</th>
                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500">Nama Satuan</th>
                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach($satuan as $s)
            <tr class="hover:bg-slate-50/50">
                <td class="px-6 py-4 text-slate-500 font-mono">#{{ $s->id_satuan }}</td>
                <td class="px-6 py-4">
                    <span class="font-semibold text-slate-700">{{ $s->nama_satuan }}</span>
                </td>
                <td class="px-6 py-4 text-right space-x-3">
                    <a href="{{ route('satuan.edit', $s->id_satuan) }}" class="text-blue-600 font-bold hover:underline">Edit</a>
                    <form action="{{ route('satuan.destroy', $s->id_satuan) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 font-bold hover:underline" onclick="return confirm('Hapus satuan ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="modalSatuan" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-2xl w-full max-w-md shadow-2xl scale-in">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center">
            <h3 class="text-xl font-bold text-slate-800">Tambah Satuan Baru</h3>
            <button onclick="document.getElementById('modalSatuan').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-2xl">&times;</button>
        </div>
        <form action="{{ route('satuan.store') }}" method="POST" class="p-6">
            @csrf
            <div class="mb-5">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Satuan</label>
                <input type="text" name="nama_satuan" required placeholder="Misal: Sak"
                       class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                <p class="mt-2 text-xs text-slate-500 italic">*Maksimal 20 karakter sesuai standar database.</p>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700 shadow-lg transition-all active:scale-95">
                Simpan Satuan
            </button>
        </form>
    </div>
</div>
@endsection