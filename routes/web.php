<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Halaman Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- AUTH ROUTES (Sudah Login) ---
Route::middleware('auth')->group(function () {
    
    // Dashboard (Bisa diakses Admin & Kasir)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // // --- GRUP KHUSUS ADMIN (Master Data & Laporan) ---
    Route::middleware('role:admin')->group(function () {
        Route::resource('kategori', KategoriController::class);
        Route::resource('satuan', SatuanController::class); // Bisa pakai controller yang sama atau pisah
        Route::resource('produk', ProdukController::class);
        Route::resource('pelanggan', PelangganController::class);
        Route::resource('supplier', SupplierController::class);
        
        // Laporan Khusus Admin
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/penjualan', [LaporanController::class, 'penjualan'])->name('laporan.penjualan');
        Route::get('/laporan/terlaris', [LaporanController::class, 'terlaris'])->name('laporan.terlaris');
        Route::get('/laporan/stok-menipis', [LaporanController::class, 'stokMenipis'])->name('laporan.stok_menipis');
        Route::get('/laporan/penjualan/cetak', [LaporanController::class, 'cetakPenjualan'])->name('laporan.penjualan.cetak');
    });

    // --- GRUP KASIR & ADMIN (Transaksi) ---
    Route::middleware('role:kasir,admin')->group(function () {
        Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
        Route::get('/penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create');
        Route::post('/penjualan', [PenjualanController::class, 'store'])->name('penjualan.store');
        Route::get('/penjualan/{id}', [PenjualanController::class, 'show'])->name('penjualan.show');
        
        // Rute untuk menampilkan form pembayaran
        Route::get('/pembayaran/{id_nota}', [PenjualanController::class, 'pembayaran'])->name('pembayaran.create');

        // Rute untuk memproses/menyimpan data pembayaran (INI YANG HARUS DITAMBAHKAN/DIPERBAIKI)
        Route::post('/pembayaran/{id_nota}', [PenjualanController::class, 'prosesPembayaran'])->name('pembayaran.store');
    });

});