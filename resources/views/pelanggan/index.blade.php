@extends('layouts.app')

@section('title', 'Manajemen Pelanggan')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Daftar Pelanggan</h2>
        <p class="text-slate-500 text-sm">Kelola data pembeli tetap dan mitra proyek.</p>
    </div>
    <button onclick="document.getElementById('modalPelanggan').classList.remove('hidden')" 
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-bold transition-all shadow-md">
        + Tambah Pelanggan
    </button>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500">Nama Pelanggan</th>
                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500">No. HP</th>
                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500">Tipe</th>
                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500">Asal Kota</th>
                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500">Tgl Daftar</th>
                <th class="px-6 py-4 text-xs font-bold uppercase text-slate-500 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach($pelanggan as $p)
            <tr class="hover:bg-slate-50/50 transition-colors">
                <td class="px-6 py-4 font-bold text-slate-700">{{ $p->nama_pelanggan }}</td>
                <td class="px-6 py-4 text-slate-600">{{ $p->no_hp ?? '-' }}</td>
                <td class="px-6 py-4">
                    @php
                        $colors = [
                            'umum' => 'bg-slate-100 text-slate-600',
                            'member' => 'bg-blue-100 text-blue-700',
                            'proyek' => 'bg-amber-100 text-amber-700'
                        ];
                    @endphp
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold uppercase {{ $colors[$p->tipe] }}">
                        {{ $p->tipe }}
                    </span>
                </td>
                <td class="px-6 py-4 text-slate-500">{{ $p->kota ?? '-' }}</td>
                <td class="px-6 py-4 text-sm text-slate-500">{{ date('d M Y', strtotime($p->tgl_daftar)) }}</td>
                <td class="px-6 py-4 text-right space-x-3">
                    {{-- PASTIKAN MENGGUNAKAN id_pelanggan --}}
                    <a href="{{ route('pelanggan.edit', $p->id_pelanggan) }}" class="text-blue-600 font-bold hover:underline">Edit</a>
                    
                    <form action="{{ route('pelanggan.destroy', $p->id_pelanggan) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 font-bold hover:underline" onclick="return confirm('Hapus data pelanggan ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Modal Tambah --}}
<div id="modalPelanggan" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-2xl w-full max-w-md shadow-2xl">
        <div class="p-6 border-b flex justify-between items-center">
            <h3 class="text-xl font-bold">Tambah Pelanggan</h3>
            <button onclick="document.getElementById('modalPelanggan').classList.add('hidden')" class="text-slate-400 text-2xl">&times;</button>
        </div>
        <form action="{{ route('pelanggan.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold mb-1">Nama Lengkap</label>
                <input type="text" name="nama_pelanggan" class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none" required>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">No. HP</label>
                <input type="text" name="no_hp" class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none" placeholder="08xxxx">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Tipe Pelanggan</label>
                <select name="tipe" class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none" required>
                    <option value="umum">Umum</option>
                    <option value="member">Member</option>
                    <option value="proyek">Proyek (Kontraktor)</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Kota</label>
                <input type="text" name="kota" class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700 transition-all shadow-lg active:scale-95">
                Simpan Pelanggan
            </button>
        </form>
    </div>
</div>
@endsection