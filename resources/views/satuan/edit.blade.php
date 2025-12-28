@extends('layouts.app')

@section('title', 'Edit Satuan')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-100 bg-slate-50/50">
            <h2 class="text-xl font-bold">Edit Satuan #{{ $satuan->id_satuan }}</h2>
        </div>

        <form action="{{ route('satuan.update', $satuan->id_satuan) }}" method="POST" class="p-8">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label class="block text-sm font-semibold mb-2 text-slate-700">Nama Satuan</label>
                <input type="text" name="nama_satuan" value="{{ $satuan->nama_satuan }}" 
                       class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none" required>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('satuan.index') }}" class="px-6 py-2.5 font-bold text-slate-600">Batal</a>
                <button type="submit" class="bg-blue-600 text-white px-8 py-2.5 rounded-xl font-bold hover:bg-blue-700 transition-all shadow-md">
                    Update Satuan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection