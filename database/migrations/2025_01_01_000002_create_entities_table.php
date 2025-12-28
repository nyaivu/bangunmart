<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id('id_pegawai');
            $table->string('nama_pegawai', 100)->unique(); // Ditambah unique untuk login username
            $table->string('password'); // Kolom Password untuk Login
            $table->enum('jabatan', ['kasir', 'gudang', 'admin']);
            $table->enum('shift', ['pagi', 'siang', 'malam']);
            $table->tinyInteger('aktif')->default(1);
            $table->rememberToken(); // Opsional: Tambahkan ini jika ingin fitur "Remember Me"
        });

        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id('id_pelanggan'); 
            
            $table->string('nama_pelanggan', 100);
            $table->string('no_hp', 20)->nullable();
            $table->enum('tipe', ['umum', 'member', 'proyek'])->default('umum');
            $table->string('kota', 60)->nullable();
            $table->date('tgl_daftar')->default(DB::raw('(CURRENT_DATE)'));
        });

        Schema::create('supplier', function (Blueprint $table) {
            $table->id('id_supplier');
            $table->string('nama_supplier', 120);
            $table->string('no_hp', 20)->nullable();
            $table->string('kota', 60)->nullable();
        });
    }

    public function down() {
        Schema::dropIfExists('supplier');
        Schema::dropIfExists('pelanggan');
        Schema::dropIfExists('pegawai');
    }
};