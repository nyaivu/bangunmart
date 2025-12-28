<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        // 1. Update Detail Penjualan agar ikut terhapus jika Nota dihapus
        Schema::table('detail_penjualan', function (Blueprint $table) {
            $table->dropForeign(['id_nota']); // Hapus foreign key lama
            $table->foreign('id_nota')
                  ->references('id_nota')->on('penjualan')
                  ->onDelete('cascade');
        });

        // 2. Update Pembayaran agar ikut terhapus jika Nota dihapus
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->dropForeign(['id_nota']);
            $table->foreign('id_nota')
                  ->references('id_nota')->on('penjualan')
                  ->onDelete('cascade');
        });
    }

    public function down() {
        // Kembalikan ke Restrict jika migrasi di-rollback
        Schema::table('detail_penjualan', function (Blueprint $table) {
            $table->dropForeign(['id_nota']);
            $table->foreign('id_nota')->references('id_nota')->on('penjualan');
        });
    }
};