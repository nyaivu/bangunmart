@extends('layouts.app')

@section('title', 'Kasir Baru')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-slate-800">Input Nota Penjualan</h2>
        <span class="text-slate-500 font-mono">INV/{{ date('Ymd') }}/AUTO</span>
    </div>

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 font-bold">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('penjualan.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Pilih Pelanggan</label>
                    <select name="id_pelanggan" class="w-full px-4 py-2 border rounded-xl outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Pembeli Umum --</option>
                        @foreach($pelanggan as $p)
                            <option value="{{ $p->id_pelanggan }}">{{ $p->nama_pelanggan }} ({{ $p->tipe }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <table class="w-full text-left" id="cartTable">
                        <thead class="bg-slate-50 border-b">
                            <tr>
                                <th class="px-6 py-4 text-xs font-bold uppercase">Nama Produk</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase w-32 text-center">Qty</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase text-right">Subtotal</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase text-center w-20">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100" id="cartItems">
                            </tbody>
                    </table>
                    
                    <div class="p-6 bg-slate-50/50 border-t">
                        <button type="button" onclick="addRow()" class="text-blue-600 font-bold hover:text-blue-800 flex items-center">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Tambah Baris Barang
                        </button>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-slate-900 text-white p-8 rounded-3xl shadow-xl sticky top-8">
                    <p class="text-slate-400 text-sm uppercase tracking-widest mb-2 font-bold">Total Pembayaran</p>
                    <h3 class="text-4xl font-black mb-8" id="displayTotal">Rp 0</h3>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between text-slate-400">
                            <span>Item Terpilih</span>
                            <span id="displayCount" class="text-white font-bold">0</span>
                        </div>
                        <div class="border-t border-slate-800 pt-4">
                            <p class="text-xs text-slate-500 italic leading-relaxed">
                                *Pastikan stok mencukupi sebelum menekan tombol simpan nota.
                            </p>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 py-4 rounded-2xl font-black text-lg transition-all shadow-lg active:scale-95">
                        SIMPAN NOTA
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    const produkList = @json($produk);

    function addRow() {
        const tbody = document.getElementById('cartItems');
        const rowId = Date.now();
        const tr = document.createElement('tr');
        tr.id = `row-${rowId}`;
        
        // Perhatikan penambahan class 'product-select', 'qty-input', dan 'subtotal-text'
        tr.innerHTML = `
            <td class="px-6 py-4">
                <select name="id_produk[]" onchange="calculateTotal()" class="product-select w-full px-3 py-2 border rounded-lg focus:ring-blue-500 outline-none" required>
                    <option value="">-- Pilih Barang --</option>
                    @${produkList.map(p => `
                        <option value="${p.id_produk}" data-price="${p.harga_jual}">
                            ${p.nama_produk} (Stok: ${p.stok})
                        </option>
                    `).join('')}
                </select>
            </td>
            <td class="px-6 py-4">
                <input type="number" name="qty[]" value="1" min="1" oninput="calculateTotal()" class="qty-input w-full px-3 py-2 border rounded-lg text-center" required>
            </td>
            <td class="px-6 py-4 text-right font-bold text-slate-700">
                <span class="subtotal-text">Rp 0</span>
            </td>
            <td class="px-6 py-4 text-center">
                <button type="button" onclick="removeRow(${rowId})" class="text-red-500 hover:text-red-700 font-bold text-xl">&times;</button>
            </td>
        `;
        tbody.appendChild(tr);
        calculateTotal();
    }

    function removeRow(id) {
        const row = document.getElementById(`row-${id}`);
        if (row) {
            row.remove();
            calculateTotal();
        }
    }

    function calculateTotal() {
        let grandTotal = 0;
        let count = 0;
        const rows = document.querySelectorAll('#cartItems tr');

        rows.forEach(row => {
            const select = row.querySelector('.product-select');
            const qtyInput = row.querySelector('.qty-input');
            const subtotalSpan = row.querySelector('.subtotal-text');
            
            if (select && select.value && subtotalSpan) {
                // Mengambil harga dari atribut data-price pada option yang dipilih
                const price = parseFloat(select.options[select.selectedIndex].getAttribute('data-price')) || 0;
                const qty = parseInt(qtyInput.value) || 0;
                const subtotal = price * qty;
                
                grandTotal += subtotal;
                count++;
                
                // Update teks subtotal per baris
                subtotalSpan.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(subtotal);
            } else if (subtotalSpan) {
                subtotalSpan.innerText = 'Rp 0';
            }
        });

        // Update total besar dan jumlah item di panel sebelah kanan
        document.getElementById('displayTotal').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(grandTotal);
        document.getElementById('displayCount').innerText = count;
    }

    document.addEventListener('DOMContentLoaded', function() {
        addRow();
    });
</script>
@endsection