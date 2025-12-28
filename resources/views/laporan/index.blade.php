@extends('layouts.app')

@section('title', 'Pusat Laporan')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-8">
        <h2 class="text-3xl font-black text-slate-800">Pusat Laporan</h2>
        <p class="text-slate-500">Analisis performa toko dan ketersediaan stok BangunMart.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('laporan.penjualan') }}" class="group bg-white p-8 rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl hover:border-blue-500 transition-all">
            <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-all">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Laporan Penjualan</h3>
            <p class="text-sm text-slate-500 mb-4">Lihat omzet harian dan riwayat pembayaran pelanggan.</p>
            <div class="text-blue-600 font-bold flex items-center text-sm">
                Lihat Detail <span class="ml-2">→</span>
            </div>
        </a>

        <a href="{{ route('laporan.terlaris') }}" class="group bg-white p-8 rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl hover:border-amber-500 transition-all">
            <div class="w-14 h-14 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-amber-600 group-hover:text-white transition-all">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Produk Terlaris</h3>
            <p class="text-sm text-slate-500 mb-4">Analisis 10 produk dengan volume penjualan tertinggi.</p>
            <div class="text-amber-600 font-bold flex items-center text-sm">
                Lihat Detail <span class="ml-2">→</span>
            </div>
        </a>

        <a href="{{ route('laporan.stok_menipis') }}" class="group bg-white p-8 rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl hover:border-red-500 transition-all">
            <div class="w-14 h-14 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-red-600 group-hover:text-white transition-all">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Stok Menipis</h3>
            <p class="text-sm text-slate-500 mb-4">
                Ada <span class="font-bold text-red-600">{{ $totalStokMenipis }} produk</span> yang perlu dipesan kembali.
            </p>
            <div class="text-red-600 font-bold flex items-center text-sm">
                Lihat Detail <span class="ml-2">→</span>
            </div>
        </a>
    </div>
</div>
@endsection