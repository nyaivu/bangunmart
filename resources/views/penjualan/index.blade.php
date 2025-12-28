@extends('layouts.app')
@section('title', 'Riwayat Penjualan')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Riwayat Nota Penjualan</h2>
    <a href="{{ route('penjualan.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-xl font-bold hover:bg-blue-700">Buat Nota Baru</a>
</div>

<div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-slate-50 border-b">
            <tr>
                <th class="px-6 py-4 text-xs font-bold uppercase">No. Nota</th>
                <th class="px-6 py-4 text-xs font-bold uppercase">Tanggal</th>
                <th class="px-6 py-4 text-xs font-bold uppercase">Pelanggan</th>
                <th class="px-6 py-4 text-xs font-bold uppercase">Kasir</th>
                <th class="px-6 py-4 text-xs font-bold uppercase">Status</th>
                <th class="px-6 py-4 text-xs font-bold uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @foreach($penjualan as $p)
            <tr class="hover:bg-slate-50">
                <td class="px-6 py-4 font-mono text-blue-600 font-bold">#{{ $p->id_nota }}</td>
                <td class="px-6 py-4">{{ $p->tgl_nota }}</td>
                <td class="px-6 py-4">{{ $p->pelanggan->nama_pelanggan ?? 'Umum' }}</td>
                <td class="px-6 py-4 text-sm">{{ $p->pegawai->nama_pegawai }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 rounded-full text-xs font-bold {{ $p->status_nota == 'baru' ? 'bg-amber-100 text-amber-700' : 'bg-green-100 text-green-700' }}">
                        {{ strtoupper($p->status_nota) }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <a href="{{ route('penjualan.show', $p->id_nota) }}" class="text-blue-600 font-bold hover:underline">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection