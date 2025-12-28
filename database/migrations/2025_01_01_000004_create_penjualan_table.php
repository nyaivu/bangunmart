<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id('id_nota');
            $table->dateTime('tgl_nota')->useCurrent();
            $table->unsignedBigInteger('id_pegawai');
            $table->unsignedBigInteger('id_pelanggan')->nullable();
            $table->decimal('diskon_nota', 12, 2)->default(0);
            $table->enum('status_nota', ['baru', 'dibayar', 'batal'])->default('baru');

            $table->foreign('id_pegawai')->references('id_pegawai')->on('pegawai');
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan');
        });
    }
    public function down() {
        Schema::dropIfExists('penjualan');
    }
};