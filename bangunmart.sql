-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 29, 2025 at 06:05 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bangunmart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id_nota` bigint UNSIGNED NOT NULL,
  `id_produk` bigint UNSIGNED NOT NULL,
  `qty` int NOT NULL,
  `harga_satuan` decimal(12,2) NOT NULL,
  `diskon_item` decimal(12,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id_nota`, `id_produk`, `qty`, `harga_satuan`, `diskon_item`) VALUES
(1, 1, 5, 65000.00, 0.00),
(1, 2, 1, 215000.00, 0.00),
(2, 4, 4, 25000.00, 0.00),
(2, 6, 10, 85000.00, 0.00),
(3, 10, 2, 950000.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Semen & Mortar'),
(2, 'Cat & Perlengkapan'),
(3, 'Besi & Logam'),
(4, 'Pipa & Plumbing'),
(5, 'Keramik & Granit'),
(6, 'Kayu & Papan'),
(7, 'Atap & Plafon'),
(8, 'Paku & Baut'),
(9, 'Alat Pertukangan'),
(10, 'Sanitari & Kamar Mandi');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_01_000001_create_kategori_table', 1),
(5, '2025_01_01_000002_create_entities_table', 1),
(6, '2025_01_01_000003_create_produk_table', 1),
(7, '2025_01_01_000004_create_penjualan_table', 1),
(8, '2025_01_01_000005_create_detail_penjualan_table', 1),
(9, '2025_01_01_000006_create_final_tables', 1),
(10, '2025_12_28_154148_update_foreign_key_cascade', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` bigint UNSIGNED NOT NULL,
  `nama_pegawai` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` enum('kasir','gudang','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` enum('pagi','siang','malam') COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktif` tinyint NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `password`, `jabatan`, `shift`, `aktif`, `remember_token`) VALUES
(1, 'Admin Utama', '$2y$12$9.zKNFe/sdqYQlCykDhU1O7cRZuOdaTrJBdmqbb.3a05L4Lo8K1bq', 'admin', 'pagi', 1, NULL),
(2, 'Kasir Budi', '$2y$12$V/W5Vnk0JmX4rR7AxXouv.Y8dW/nETeD37JiZLa14iGz7hf51DgTa', 'kasir', 'siang', 1, NULL),
(3, 'Staf 1', '$2y$12$oU2VhT/uIJs1EVsKIUHJkuV2DPgAfKxVuB4RG8TzdQA8D/aJLynfu', 'admin', 'malam', 1, NULL),
(4, 'Staf 2', '$2y$12$U5100YiJWtrqQB6sqoyu5.N6FrLbtY8vnzl2f/eMIqxcOPnt0peSS', 'gudang', 'siang', 1, NULL),
(5, 'Staf 3', '$2y$12$cYHdTpT0v6jZp6oZIFxUp.TMVo3nErE1hNRhuukKa/RhaGVth3ncK', 'kasir', 'malam', 1, NULL),
(6, 'Staf 4', '$2y$12$of39WPlAvrYgG5HhD80pt.6r7S/g3Qb8ptc6Kv3NDCUBuAJDr1r4K', 'kasir', 'malam', 1, NULL),
(7, 'Staf 5', '$2y$12$ypRUckyCGxNTl09ePEsDHuO/1bRZiarJsFgaVsB8DeFj12tW8rYwC', 'gudang', 'siang', 1, NULL),
(8, 'Staf 6', '$2y$12$l0/ebLlgDbWuB1rBEKjPuOTL8kXceXgK8dNeHCUvA0ws23Kv1araK', 'kasir', 'siang', 1, NULL),
(9, 'Staf 7', '$2y$12$G05xqgjHFFM2T5X1fCh/ROMEKETWo2F/X0FTAVJ.u0eaOUFUy3cAS', 'admin', 'malam', 1, NULL),
(10, 'Staf 8', '$2y$12$T9LuQ5lqwkgNdswJSP4AreK1HaiJHb3FSESiW3XCKNBjJ08.XTT.u', 'kasir', 'malam', 1, NULL),
(11, 'Staf 9', '$2y$12$iS7RmhmbfOYISJ66IAHSwutnVs9fvRxNY9WCRaDSfRIDo/l8VU7Pi', 'admin', 'malam', 1, NULL),
(12, 'Staf 10', '$2y$12$AnQusoJx7739K9gXThqsAOQDgscaPeS9sYrKGKJY0T3i5Z/5c/1Gm', 'admin', 'pagi', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` bigint UNSIGNED NOT NULL,
  `nama_pelanggan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe` enum('umum','member','proyek') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'umum',
  `kota` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_daftar` date NOT NULL DEFAULT (curdate())
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `no_hp`, `tipe`, `kota`, `tgl_daftar`) VALUES
(1, 'Budi Santoso', '085219553814', 'umum', 'Palangka Raya', '2025-12-29'),
(2, 'CV Maju Jaya Konstruksi', '085225730181', 'proyek', 'Banjarmasin', '2025-12-29'),
(3, 'Andi Wijaya', '085237302306', 'member', 'Palangka Raya', '2025-12-29'),
(4, 'PT Bangun Rumah Sejahtera', '085247789399', 'proyek', 'Sampit', '2025-12-29'),
(5, 'Siti Aminah', '085225375488', 'umum', 'Palangka Raya', '2025-12-29'),
(6, 'Haji Mansyur', '085228750286', 'member', 'Kuala Kapuas', '2025-12-29'),
(7, 'Dekor Interior Mandiri', '085272287140', 'proyek', 'Palangka Raya', '2025-12-29'),
(8, 'Rizky Pratama', '085273088493', 'umum', 'Palangka Raya', '2025-12-29'),
(9, 'Member Setia BangunMart', '085274580762', 'member', 'Palangka Raya', '2025-12-29'),
(10, 'Toko Besi Berkah', '085246300816', 'umum', 'Pangkalan Bun', '2025-12-29');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_bayar` bigint UNSIGNED NOT NULL,
  `id_nota` bigint UNSIGNED NOT NULL,
  `metode` enum('cash','debit','transfer','qris') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_tagihan` decimal(12,2) NOT NULL,
  `jumlah_bayar` decimal(12,2) NOT NULL,
  `kembalian` decimal(12,2) NOT NULL,
  `tgl_bayar` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_bayar` enum('berhasil','gagal') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'berhasil'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_bayar`, `id_nota`, `metode`, `jumlah_tagihan`, `jumlah_bayar`, `kembalian`, `tgl_bayar`, `status_bayar`) VALUES
(1, 1, 'cash', 540000.00, 600000.00, 60000.00, '2025-12-30 02:04:34', 'berhasil'),
(2, 2, 'transfer', 950000.00, 950000.00, 0.00, '2025-12-30 02:04:34', 'berhasil'),
(3, 3, 'qris', 1900000.00, 1900000.00, 0.00, '2025-12-30 02:04:34', 'berhasil');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_nota` bigint UNSIGNED NOT NULL,
  `tgl_nota` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_pegawai` bigint UNSIGNED NOT NULL,
  `id_pelanggan` bigint UNSIGNED DEFAULT NULL,
  `diskon_nota` decimal(12,2) NOT NULL DEFAULT '0.00',
  `status_nota` enum('baru','dibayar','batal') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'baru'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_nota`, `tgl_nota`, `id_pegawai`, `id_pelanggan`, `diskon_nota`, `status_nota`) VALUES
(1, '2023-12-01 10:00:00', 1, 1, 0.00, 'dibayar'),
(2, '2023-12-01 11:30:00', 2, 2, 0.00, 'dibayar'),
(3, '2023-12-02 09:15:00', 1, 3, 0.00, 'dibayar');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` bigint UNSIGNED NOT NULL,
  `id_kategori` bigint UNSIGNED NOT NULL,
  `id_satuan` bigint UNSIGNED NOT NULL,
  `barcode` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_jual` decimal(12,2) NOT NULL,
  `stok` int NOT NULL,
  `stok_minimum` int NOT NULL DEFAULT '5',
  `rak` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `id_satuan`, `barcode`, `nama_produk`, `harga_jual`, `stok`, `stok_minimum`, `rak`, `status`) VALUES
(1, 1, 4, '8996597592791', 'Semen Tiga Roda 50kg', 65000.00, 31, 10, 'Gudang-A1', 'aktif'),
(2, 2, 5, '8997848922860', 'Cat Mowilex Emulsion White 5L', 215000.00, 47, 10, 'Gudang-A3', 'aktif'),
(3, 3, 2, '8992643083129', 'Paku Beton 5cm (Per Kotak)', 35000.00, 59, 10, 'Gudang-E3', 'aktif'),
(4, 4, 2, '8993279741762', 'Pipa PVC Rucika 1/2 Inch', 25000.00, 34, 10, 'Gudang-F1', 'aktif'),
(5, 5, 5, '8999457097660', 'Keramik Arwana 40x40 Putih', 55000.00, 35, 10, 'Gudang-F1', 'aktif'),
(6, 6, 3, '8991254856090', 'Besi Beton 10mm SNI', 85000.00, 30, 10, 'Gudang-A4', 'aktif'),
(7, 7, 1, '8997777556289', 'Kayu Meranti 4x6 (Per Batang)', 45000.00, 69, 10, 'Gudang-D3', 'aktif'),
(8, 8, 5, '8991888508990', 'Gypsum Jayaboard 9mm', 95000.00, 94, 10, 'Gudang-B2', 'aktif'),
(9, 9, 1, '8996033465159', 'Seng Gelombang Gajah', 60000.00, 88, 10, 'Gudang-C1', 'aktif'),
(10, 10, 3, '8992881758830', 'Tangki Air Profil Tank 500L', 950000.00, 90, 10, 'Gudang-C3', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `produk_supplier`
--

CREATE TABLE `produk_supplier` (
  `id_produk` bigint UNSIGNED NOT NULL,
  `id_supplier` bigint UNSIGNED NOT NULL,
  `harga_beli_terakhir` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk_supplier`
--

INSERT INTO `produk_supplier` (`id_produk`, `id_supplier`, `harga_beli_terakhir`) VALUES
(1, 3, 60000.00),
(1, 9, 59500.00),
(2, 5, 195000.00),
(3, 1, 28000.00),
(4, 7, 21000.00),
(5, 4, 48000.00),
(6, 8, 81000.00),
(7, 1, 38000.00),
(8, 6, 88000.00),
(9, 10, 54000.00),
(10, 1, 880000.00);

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` bigint UNSIGNED NOT NULL,
  `nama_satuan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`) VALUES
(1, 'Kotak'),
(2, 'Botol'),
(3, 'Pcs'),
(4, 'Sachet'),
(5, 'Kilogram'),
(6, 'Liter'),
(7, 'Pack'),
(8, 'Unit'),
(9, 'Meter'),
(10, 'Ikat');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2N1sYY3uoRFnf8juciEqc45DuaNNeTkW5RczBuNk', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiU0NpbEkzWkQ5V0xUSmV6V2tSWkVYaTFpcDFNMWlEQ3hUbU05M0FsZSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvZGFzaGJvYXJkIjtzOjU6InJvdXRlIjtzOjk6ImRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1767031495);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` bigint UNSIGNED NOT NULL,
  `nama_supplier` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `no_hp`, `kota`) VALUES
(1, 'PT Catur Sentosa Adiprana', '081211094445', 'Jakarta'),
(2, 'PT Surya Toto Indonesia', '081256729864', 'Tangerang'),
(3, 'PT Indocement Tunggal Prakarsa', '081217802719', 'Bogor'),
(4, 'PT Arwana Citramulia', '081292119047', 'Gresik'),
(5, 'PT Mowilex Indonesia', '081250857696', 'Jakarta'),
(6, 'PT Siam-Indo Gypsum', '081298462338', 'Bekasi'),
(7, 'PT Bakrie Pipe Industries', '081268392138', 'Bekasi'),
(8, 'PT Krakatau Steel', '081286172678', 'Cilegon'),
(9, 'PT Semen Indonesia', '081254003120', 'Gresik'),
(10, 'PT Djabesmen', '081277086529', 'Jakarta');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id_nota`,`id_produk`),
  ADD KEY `detail_penjualan_id_produk_foreign` (`id_produk`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD UNIQUE KEY `pegawai_nama_pegawai_unique` (`nama_pegawai`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_bayar`),
  ADD UNIQUE KEY `pembayaran_id_nota_unique` (`id_nota`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_nota`),
  ADD KEY `penjualan_id_pegawai_foreign` (`id_pegawai`),
  ADD KEY `penjualan_id_pelanggan_foreign` (`id_pelanggan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD UNIQUE KEY `produk_barcode_unique` (`barcode`),
  ADD KEY `produk_id_kategori_foreign` (`id_kategori`),
  ADD KEY `produk_id_satuan_foreign` (`id_satuan`);

--
-- Indexes for table `produk_supplier`
--
ALTER TABLE `produk_supplier`
  ADD PRIMARY KEY (`id_produk`,`id_supplier`),
  ADD KEY `produk_supplier_id_supplier_foreign` (`id_supplier`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_bayar` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_nota` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `detail_penjualan_id_nota_foreign` FOREIGN KEY (`id_nota`) REFERENCES `penjualan` (`id_nota`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_penjualan_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_id_nota_foreign` FOREIGN KEY (`id_nota`) REFERENCES `penjualan` (`id_nota`) ON DELETE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`),
  ADD CONSTRAINT `penjualan_id_pelanggan_foreign` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `produk_id_satuan_foreign` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id_satuan`);

--
-- Constraints for table `produk_supplier`
--
ALTER TABLE `produk_supplier`
  ADD CONSTRAINT `produk_supplier_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`),
  ADD CONSTRAINT `produk_supplier_id_supplier_foreign` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
