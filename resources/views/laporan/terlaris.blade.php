@extends('layouts.app')
@section('content')
<div class="bg-white p-6 rounded-2xl shadow-sm border">
    <h2 class="text-2xl font-bold text-slate-800 mb-4">🏆 10 Produk Terlaris</h2>
    <div class="space-y-4">
        @foreach($terlaris as $item)
        <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl">
            <span class="font-bold text-slate-700">{{ $item->produk->nama_produk }}</span>
            <span class="bg-blue-600 text-white px-4 py-1 rounded-full font-bold">
                {{ $item->total_terjual }} Terjual
            </span>
        </div>
        @endforeach
    </div>
</div>
@endsection