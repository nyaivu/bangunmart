@extends('layouts.app')

@section('title', 'Edit Supplier')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b bg-slate-50/50">
            <h2 class="text-xl font-bold">Edit Supplier #{{ $supplier->id_supplier }}</h2>
        </div>
        <form action="{{ route('supplier.update', $supplier->id_supplier) }}" method="POST" class="p-8 space-y-6">
            @csrf 
            @method('PUT')
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nama Supplier</label>
                <input type="text" name="nama_supplier" value="{{ $supplier->nama_supplier }}" class="w-full px-4 py-2.5 border rounded-xl" required>
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">No. HP</label>
                <input type="text" name="no_hp" value="{{ $supplier->no_hp }}" class="w-full px-4 py-2.5 border rounded-xl">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Kota</label>
                <input type="text" name="kota" value="{{ $supplier->kota }}" class="w-full px-4 py-2.5 border rounded-xl">
            </div>
            <div class="flex justify-end space-x-3 pt-4 border-t">
                <a href="{{ route('supplier.index') }}" class="px-6 py-2.5 font-bold text-slate-500">Batal</a>
                <button type="submit" class="bg-blue-600 text-white px-8 py-2.5 rounded-xl font-bold hover:bg-blue-700 shadow-md">
                    Update Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection