<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id_produk');
            $table->unsignedBigInteger('id_kategori');
            $table->unsignedBigInteger('id_satuan');
            $table->string('barcode', 30)->unique();
            $table->string('nama_produk', 150);
            $table->decimal('harga_jual', 12, 2);
            $table->integer('stok');
            $table->integer('stok_minimum')->default(5);
            $table->string('rak', 20)->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');

            $table->foreign('id_kategori')->references('id_kategori')->on('kategori');
            $table->foreign('id_satuan')->references('id_satuan')->on('satuan');
        });
    }
    public function down() {
        Schema::dropIfExists('produk');
    }
};