@extends('layouts.app')
@section('title', 'Detail Nota')
@section('content')
<div class="max-w-4xl mx-auto bg-white p-10 rounded-3xl shadow-lg border border-slate-200">
    <div class="flex justify-between border-b pb-8 mb-8">
        <div>
            <h1 class="text-3xl font-black text-slate-900 uppercase tracking-tighter">BangunMart</h1>
            <p class="text-slate-500 text-sm">Nota Digital #{{ $nota->id_nota }}</p>
        </div>
        <div class="text-right">
            <p class="font-bold text-slate-800">{{ $nota->pegawai->nama_pegawai }}</p>
            <p class="text-slate-500 text-xs">{{ $nota->tgl_nota }}</p>
        </div>
    </div>

    <div class="mb-8">
        <p class="text-xs font-bold text-slate-400 uppercase mb-1">Tujuan Pelanggan:</p>
        <p class="text-lg font-bold text-slate-800">{{ $nota->pelanggan->nama_pelanggan ?? 'Pembeli Umum' }}</p>
    </div>

    <table class="w-full mb-8">
        <thead class="border-b-2 border-slate-100 text-left">
            <tr>
                <th class="py-3 text-slate-500 text-sm">Barang</th>
                <th class="py-3 text-slate-500 text-sm text-center">Qty</th>
                <th class="py-3 text-slate-500 text-sm text-right">Harga Satuan</th>
                <th class="py-3 text-slate-500 text-sm text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @php $total = 0; @endphp
            @foreach($nota->detail as $d)
            @php $sub = $d->qty * $d->harga_satuan; $total += $sub; @endphp
            <tr>
                <td class="py-4 font-semibold">{{ $d->produk->nama_produk }}</td>
                <td class="py-4 text-center">{{ $d->qty }}</td>
                <td class="py-4 text-right">Rp {{ number_format($d->harga_satuan, 0, ',', '.') }}</td>
                <td class="py-4 text-right font-bold text-blue-600">Rp {{ number_format($sub, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="border-t-2 border-slate-100">
                <td colspan="3" class="py-6 text-right font-bold text-slate-500 uppercase">Total Bayar</td>
                <td class="py-6 text-right text-2xl font-black text-slate-900">Rp {{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="flex space-x-4 justify-end">
        <button onclick="window.print()" class="px-6 py-2 bg-slate-100 text-slate-600 font-bold rounded-xl">Cetak PDF</button>
        @if($nota->status_nota == 'baru')
        <a href="{{ route('pembayaran.create', $nota->id_nota) }}" class="px-6 py-2 bg-blue-600 text-white font-bold rounded-xl shadow-lg shadow-blue-200">Lanjut Pembayaran</a>
        @endif
    </div>
</div>
@endsection