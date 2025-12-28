<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('kategori', function (Blueprint $table) {
            $table->id('id_kategori');
            $table->string('nama_kategori', 60);
        });
        
        Schema::create('satuan', function (Blueprint $table) {
            $table->id('id_satuan');
            $table->string('nama_satuan', 20);
        });
    }
    public function down() {
        Schema::dropIfExists('satuan');
        Schema::dropIfExists('kategori');
    }
};