@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-bold text-slate-800">Dashboard</h2>
    <p class="text-slate-500">Ringkasan operasional BangunMart hari ini.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
        <span class="text-slate-400 text-sm font-medium uppercase tracking-wider">Total Produk</span>
        <h3 class="text-3xl font-bold mt-1">{{ $totalProduk }}</h3>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
        <span class="text-slate-400 text-sm font-medium uppercase tracking-wider">Nota Hari Ini</span>
        <h3 class="text-3xl font-bold mt-1 text-blue-600">{{ $totalPenjualanHariIni }}</h3>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
        <span class="text-slate-400 text-sm font-medium uppercase tracking-wider">Stok Menipis</span>
        <h3 class="text-3xl font-bold mt-1 text-red-600">{{ $stokMenipis->count() }}</h3>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
        <span class="text-slate-400 text-sm font-medium uppercase tracking-wider">Shift Anda</span>
        <h3 class="text-3xl font-bold mt-1 text-slate-700">{{ ucfirst(auth()->user()->shift) }}</h3>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-5 border-b border-slate-100 bg-slate-50/50">
            <h4 class="font-bold text-slate-800">Peringatan Stok Menipis</h4>
        </div>
        <div class="p-0">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-slate-500 font-medium">
                    <tr>
                        <th class="px-6 py-3">Produk</th>
                        <th class="px-6 py-3">Stok Saat Ini</th>
                        <th class="px-6 py-3">Rak</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($stokMenipis as $p)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 font-medium">{{ $p->nama_produk }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                {{ $p->stok }} {{ $p->satuan->nama_satuan ?? 'unit' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-500">{{ $p->rak ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center text-slate-400">Semua stok aman.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-5 border-b border-slate-100 bg-slate-50/50">
            <h4 class="font-bold text-slate-800">5 Produk Terlaris</h4>
        </div>
        <div class="p-6">
            <div class="space-y-6">
                @foreach($produkTerlaris as $pt)
                <div>
                    <div class="flex justify-between mb-2">
                        <span class="text-sm font-medium text-slate-700">{{ $pt->nama_produk }}</span>
                        <span class="text-sm font-bold text-blue-600">{{ $pt->total_qty }} unit</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full" style="width: {{ min(($pt->total_qty / 100) * 100, 100) }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection