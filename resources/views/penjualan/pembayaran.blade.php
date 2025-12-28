@extends('layouts.app')

@section('title', 'Proses Pembayaran')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden">
        <div class="bg-slate-900 p-8 text-white text-center">
            <p class="text-slate-400 uppercase tracking-widest text-xs font-bold mb-2">Total Tagihan</p>
            <h1 class="text-5xl font-black">Rp {{ number_format($total, 0, ',', '.') }}</h1>
            <input type="hidden" id="totalBelanja" value="{{ $total }}">
        </div>

        <form action="{{ route('pembayaran.store', $nota->id_nota) }}" method="POST" class="p-8 space-y-6">
            @csrf
            <input type="hidden" name="total_belanja" value="{{ $total }}">

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Bayar</label>
                    <input type="date" name="tgl_bayar" value="{{ date('Y-m-d') }}" class="w-full px-4 py-3 border rounded-xl outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Metode Pembayaran</label>
                    <select name="metode" class="w-full px-4 py-3 border rounded-xl outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="cash">💵 Cash / Tunai</option>
                        <option value="qris">📱 QRIS</option>
                        <option value="debit">💳 Kartu Debit</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Uang Diterima (Rp)</label>
                <input type="number" name="bayar" id="inputBayar" oninput="hitungKembalian()" 
                       class="w-full px-4 py-4 text-3xl font-bold border-2 border-blue-100 rounded-2xl focus:border-blue-500 outline-none transition-all" 
                       placeholder="Masukkan nominal..." required autofocus>
            </div>

            <div class="bg-slate-50 p-6 rounded-2xl border border-dashed border-slate-300 text-center">
                <span class="text-slate-500 font-bold uppercase text-xs block mb-1">Uang Kembalian</span>
                <span id="displayKembali" class="text-4xl font-black text-slate-800 transition-colors">Rp 0</span>
            </div>

            <div class="flex space-x-4 pt-4">
                <a href="{{ route('penjualan.show', $nota->id_nota) }}" class="flex-1 text-center py-4 font-bold text-slate-500 hover:text-slate-700 transition-colors">
                    Batal
                </a>
                <button type="submit" class="flex-[2] bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 rounded-2xl font-black text-lg shadow-lg shadow-blue-200 transition-all active:scale-95">
                    KONFIRMASI PEMBAYARAN
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function hitungKembalian() {
        const total = parseInt(document.getElementById('totalBelanja').value);
        const bayar = parseInt(document.getElementById('inputBayar').value) || 0;
        const kembali = bayar - total;
        const display = document.getElementById('displayKembali');

        if (kembali < 0) {
            display.innerText = 'Rp 0';
            display.classList.remove('text-green-600');
            display.classList.add('text-slate-800');
        } else {
            display.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(kembali);
            display.classList.remove('text-slate-800');
            display.classList.add('text-green-600');
        }
    }
</script>
@endsection