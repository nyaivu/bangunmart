@extends('layouts.app')

@section('title', 'Laporan Penjualan')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200 mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black text-slate-800">Laporan Penjualan</h2>
                <p class="text-slate-500 text-sm">Rekapitulasi pendapatan dari transaksi yang telah dibayar.</p>
            </div>
            
            <form action="{{ route('laporan.penjualan') }}" method="GET" class="flex flex-wrap items-end gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase mb-1">Mulai</label>
                    <input type="date" name="tgl_mulai" value="{{ $tgl_mulai }}" class="px-3 py-2 border rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase mb-1">Selesai</label>
                    <input type="date" name="tgl_selesai" value="{{ $tgl_selesai }}" class="px-3 py-2 border rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <button type="submit" class="bg-slate-900 text-white px-6 py-2 rounded-xl font-bold text-sm hover:bg-slate-800 transition-all">
                    Filter
                </button>
                <a href="{{ route('laporan.penjualan.cetak', request()->all()) }}" 
                class="bg-red-600 text-white px-6 py-2 rounded-xl font-bold text-sm hover:bg-red-700 transition-all flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 2l4 4H11V4z"/></svg>
                    Cetak PDF
                </a>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-blue-600 p-6 rounded-3xl text-white shadow-lg shadow-blue-100">
            <p class="text-blue-100 text-xs font-bold uppercase tracking-widest mb-1">Total Omzet</p>
            <h3 class="text-3xl font-black">Rp {{ number_format($total_omzet, 0, ',', '.') }}</h3>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm">
            <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-1">Jumlah Transaksi</p>
            <h3 class="text-3xl font-black text-slate-800">{{ $laporan->count() }}</h3>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="p-5 text-xs font-bold text-slate-500 uppercase">Waktu Nota</th>
                    <th class="p-5 text-xs font-bold text-slate-500 uppercase">Metode</th>
                    <th class="p-5 text-xs font-bold text-slate-500 uppercase text-right">Nominal Tagihan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($laporan as $row)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="p-5">
                        <span class="block font-bold text-slate-700">{{ date('d M Y', strtotime($row->tgl_nota)) }}</span>
                        <span class="text-xs text-slate-400">{{ date('H:i', strtotime($row->tgl_nota)) }} WIB</span>
                    </td>
                    <td class="p-5 text-sm">
                        <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-full font-bold uppercase text-[10px]">
                            {{ $row->metode }}
                        </span>
                    </td>
                    <td class="p-5 text-right font-black text-slate-800">
                        Rp {{ number_format($row->jumlah_tagihan, 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="p-10 text-center text-slate-400 italic">
                        Tidak ada data penjualan pada periode ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection