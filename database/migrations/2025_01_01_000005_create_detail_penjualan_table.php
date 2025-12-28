<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('detail_penjualan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_nota');
            $table->unsignedBigInteger('id_produk');
            $table->integer('qty');
            $table->decimal('harga_satuan', 12, 2);
            $table->decimal('diskon_item', 12, 2)->default(0);

            $table->primary(['id_nota', 'id_produk']);
            $table->foreign('id_nota')->references('id_nota')->on('penjualan');
            $table->foreign('id_produk')->references('id_produk')->on('produk');
        });
    }
    public function down() {
        Schema::dropIfExists('detail_penjualan');
    }
};