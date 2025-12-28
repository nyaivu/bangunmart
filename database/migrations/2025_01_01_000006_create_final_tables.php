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
            $table->unsignedBigInteger('id_produk');
            $table->unsignedBigInteger('id_supplier');
            $table->decimal('harga_beli_terakhir', 12, 2)->nullable();
            
            $table->primary(['id_produk', 'id_supplier']);
            $table->foreign('id_produk')->references('id_produk')->on('produk');
            $table->foreign('id_supplier')->references('id_supplier')->on('supplier');
        });
    }
    public function down() {
        Schema::dropIfExists('produk_supplier');
        Schema::dropIfExists('pembayaran');
    }
};