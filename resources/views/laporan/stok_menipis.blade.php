@extends('layouts.app')
@section('content')
<div class="bg-white p-6 rounded-2xl shadow-sm border">
    <h2 class="text-2xl font-bold text-red-600 mb-4">⚠️ Laporan Stok Menipis</h2>
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-50">
            <tr>
                <th class="p-4 border-b">Produk</th>
                <th class="p-4 border-b">Sisa Stok</th>
                <th class="p-4 border-b">Batas Minimum</th>
                <th class="p-4 border-b">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produk as $p)
            <tr>
                <td class="p-4 border-b font-bold">{{ $p->nama_produk }}</td>
                <td class="p-4 border-b text-red-600 font-bold">{{ $p->stok }}</td>
                <td class="p-4 border-b">{{ $p->stok_minimum }}</td>
                <td class="p-4 border-b">
                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded-lg text-xs font-bold">RE-ORDER</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection