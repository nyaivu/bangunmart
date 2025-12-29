<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_bayar');
            $table->unsignedBigInteger('id_nota')->unique();
            $table->enum('metode', ['cash', 'debit', 'transfer', 'qris']);
            $table->decimal('jumlah_tagihan', 12, 2);
            $table->decimal('jumlah_bayar', 12, 2);
            $table->decimal('kembalian', 12, 2);
            $table->dateTime('tgl_bayar')->useCurrent();
            $table->enum('status_bayar', ['berhasil', 'gagal'])->default('berhasil');

            $table->foreign('id_nota')->references('id_nota')->on('penjualan');
        });

        Schema::create('produk_supplier', function (Blueprint $table) {
            $table->foreignId('id_produk')
                ->constrained('produk', 'id_produk')
                ->onDelete('cascade'); // Otomatis hapus data jika produk dihapus

            $table->foreignId('id_supplier')
                ->constrained('supplier', 'id_supplier')
                ->onDelete('cascade'); // Otomatis hapus data jika supplier dihapus

            $table->decimal('harga_beli_terakhir', 15, 2);
            
            $table->primary(['id_produk', 'id_supplier']);
        });
    }
    public function down() {
        Schema::dropIfExists('produk_supplier');
        Schema::dropIfExists('pembayaran');
    }
};