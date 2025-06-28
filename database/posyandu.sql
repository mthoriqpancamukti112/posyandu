-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 28, 2025 at 04:10 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `posyandu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `balita`
--

CREATE TABLE `balita` (
  `id` bigint UNSIGNED NOT NULL,
  `orangtua_id` bigint UNSIGNED NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_anak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `balita`
--

INSERT INTO `balita` (`id`, `orangtua_id`, `nik`, `nama_anak`, `jenis_kelamin`, `tgl_lahir`, `created_at`, `updated_at`) VALUES
(2, 1, '1234567890123456', 'Muthopati Akbar', 'L', '2022-07-19', '2024-07-18 08:18:45', '2024-07-18 08:18:45'),
(3, 1, '1234567890123454', 'Contoh', 'L', '2022-07-19', '2024-07-18 16:26:47', '2024-07-18 16:27:33'),
(4, 3, '1234567890145323', 'Hadi Gunawan', 'L', '2022-07-26', '2024-07-25 21:44:24', '2024-07-25 21:44:24');

-- --------------------------------------------------------

--
-- Table structure for table `bidan`
--

CREATE TABLE `bidan` (
  `id` bigint UNSIGNED NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_bidan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `no_hp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bidan`
--

INSERT INTO `bidan` (`id`, `nik`, `nip`, `nama_bidan`, `tgl_lahir`, `alamat`, `no_hp`, `created_at`, `updated_at`) VALUES
(1, '1234567890123456', '1234567890432135', 'Bidan 1', '2024-07-18', 'Lestari Penan', '089876564443', '2024-07-17 19:36:05', '2024-07-17 19:36:05');

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
-- Table structure for table `imunisasi`
--

CREATE TABLE `imunisasi` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `bidan_id` bigint UNSIGNED DEFAULT NULL,
  `balita_id` bigint UNSIGNED NOT NULL,
  `vaksin_id` bigint UNSIGNED DEFAULT NULL,
  `tanggal` date NOT NULL,
  `kondisi` enum('Y','T') COLLATE utf8mb4_unicode_ci NOT NULL,
  `usia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `imunisasi`
--

INSERT INTO `imunisasi` (`id`, `user_id`, `bidan_id`, `balita_id`, `vaksin_id`, `tanggal`, `kondisi`, `usia`, `created_at`, `updated_at`) VALUES
(5, 1, NULL, 2, 1, '2024-07-19', 'Y', '2 tahun', '2024-07-18 16:04:39', '2024-07-18 16:04:39'),
(6, 1, NULL, 3, 1, '2024-07-19', 'Y', '2 tahun', '2024-07-18 16:27:49', '2024-07-18 16:27:49'),
(7, 1, NULL, 4, 2, '2024-07-26', 'Y', '2 tahun', '2024-07-25 21:45:02', '2024-07-25 21:45:02'),
(8, 1, NULL, 2, 2, '2024-07-26', 'Y', '2 tahun 7 hari', '2024-07-25 22:00:44', '2024-07-25 22:00:44'),
(10, 1, NULL, 3, 1, '2024-07-26', 'Y', '2 tahun 7 hari', '2024-07-25 22:19:17', '2024-07-25 22:19:17');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `bidan_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` date DEFAULT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2024_05_25_225838_create_admin_table', 1),
(5, '2024_05_25_230647_create_vaksin_table', 1),
(6, '2024_05_26_084205_create_orangtua_table', 2),
(7, '2024_05_26_084330_create_bidan_table', 2),
(8, '2024_05_26_084434_create_users_table', 2),
(9, '2024_05_26_084547_create_jadwal_table', 2),
(10, '2024_06_17_021946_create_balita_table', 2),
(11, '2024_06_17_022025_create_imunisasi_table', 2),
(12, '2024_06_17_022047_create_penimbangan_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orangtua`
--

CREATE TABLE `orangtua` (
  `id` bigint UNSIGNED NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_ortu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `no_hp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orangtua`
--

INSERT INTO `orangtua` (`id`, `nik`, `nama_ortu`, `tgl_lahir`, `no_hp`, `created_at`, `updated_at`) VALUES
(1, '590293729307290', 'M Thoriq Panca Mukti saja', '2000-01-10', '081233799312', '2024-06-16 18:26:34', '2024-07-17 19:47:45'),
(3, '1234567890123454', 'Ahyar Hadi', '1998-06-26', '081233799312', '2024-07-25 21:43:12', '2024-07-25 21:43:12');

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
-- Table structure for table `penimbangan`
--

CREATE TABLE `penimbangan` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `balita_id` bigint UNSIGNED NOT NULL,
  `bidan_id` bigint UNSIGNED DEFAULT NULL,
  `tgl_timbang` date NOT NULL,
  `usia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat_badan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tinggi_badan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perkembangan` enum('Y','T') COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','bidan','ortu') COLLATE utf8mb4_unicode_ci NOT NULL,
  `bidan_id` bigint UNSIGNED DEFAULT NULL,
  `orangtua_id` bigint UNSIGNED DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `bidan_id`, `orangtua_id`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Kader Posyandu', 'admin@admin.com', '$2y$10$MySWXSn/mWkHBDFbmEdZV.rikl5p3erSPel4DnwViVkkCVy59/asa', 'admin', NULL, NULL, NULL, NULL, '2024-06-16 18:21:54', '2024-06-16 18:21:54'),
(2, 'Thoriq', 'thoriq@gmail.com', '$2y$10$Dxn7f.JXfGVRiw1C94/9a.ayLUXgai7isPFp8CcnEUbkKeZfDmvdW', 'ortu', NULL, 1, NULL, NULL, '2024-06-16 18:26:34', '2024-06-16 18:26:34'),
(3, 'Bidan Aja', 'bidan@gmail.com', '$2y$10$JLBUgWVMzrfAqMBMYwZPO.O2odVHwYqY1OTeY1mv9Ynl.txUtA26K', 'bidan', 1, NULL, NULL, NULL, '2024-07-17 19:36:05', '2024-07-17 19:37:13'),
(5, 'Ahyar', 'ahyar@gmail.com', '$2y$10$q64yvV8HlxVYa4PdSE.R5eFaqbLwDVmsJbKWarfZZYA4GfoxpzWye', 'ortu', NULL, 3, NULL, NULL, '2024-07-25 21:43:13', '2024-07-25 21:43:13');

-- --------------------------------------------------------

--
-- Table structure for table `vaksin`
--

CREATE TABLE `vaksin` (
  `id` bigint UNSIGNED NOT NULL,
  `jenis_vaksin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vaksin`
--

INSERT INTO `vaksin` (`id`, `jenis_vaksin`, `stok`, `created_at`, `updated_at`) VALUES
(1, 'HB', 63, '2024-06-16 18:36:03', '2024-07-25 22:19:17'),
(2, 'HC', 77, '2024-06-16 18:36:11', '2024-07-25 22:18:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_email_unique` (`email`);

--
-- Indexes for table `balita`
--
ALTER TABLE `balita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `balita_orangtua_id_foreign` (`orangtua_id`);

--
-- Indexes for table `bidan`
--
ALTER TABLE `bidan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `imunisasi`
--
ALTER TABLE `imunisasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imunisasi_user_id_foreign` (`user_id`),
  ADD KEY `imunisasi_bidan_id_foreign` (`bidan_id`),
  ADD KEY `imunisasi_balita_id_foreign` (`balita_id`),
  ADD KEY `imunisasi_vaksin_id_foreign` (`vaksin_id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_user_id_foreign` (`user_id`),
  ADD KEY `jadwal_bidan_id_foreign` (`bidan_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orangtua`
--
ALTER TABLE `orangtua`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `penimbangan`
--
ALTER TABLE `penimbangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penimbangan_user_id_foreign` (`user_id`),
  ADD KEY `penimbangan_balita_id_foreign` (`balita_id`),
  ADD KEY `penimbangan_bidan_id_foreign` (`bidan_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_bidan_id_foreign` (`bidan_id`),
  ADD KEY `users_orangtua_id_foreign` (`orangtua_id`);

--
-- Indexes for table `vaksin`
--
ALTER TABLE `vaksin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `balita`
--
ALTER TABLE `balita`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bidan`
--
ALTER TABLE `bidan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `imunisasi`
--
ALTER TABLE `imunisasi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orangtua`
--
ALTER TABLE `orangtua`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penimbangan`
--
ALTER TABLE `penimbangan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vaksin`
--
ALTER TABLE `vaksin`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `balita`
--
ALTER TABLE `balita`
  ADD CONSTRAINT `balita_orangtua_id_foreign` FOREIGN KEY (`orangtua_id`) REFERENCES `orangtua` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `imunisasi`
--
ALTER TABLE `imunisasi`
  ADD CONSTRAINT `imunisasi_balita_id_foreign` FOREIGN KEY (`balita_id`) REFERENCES `balita` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `imunisasi_bidan_id_foreign` FOREIGN KEY (`bidan_id`) REFERENCES `bidan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `imunisasi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `imunisasi_vaksin_id_foreign` FOREIGN KEY (`vaksin_id`) REFERENCES `vaksin` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_bidan_id_foreign` FOREIGN KEY (`bidan_id`) REFERENCES `bidan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penimbangan`
--
ALTER TABLE `penimbangan`
  ADD CONSTRAINT `penimbangan_balita_id_foreign` FOREIGN KEY (`balita_id`) REFERENCES `balita` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penimbangan_bidan_id_foreign` FOREIGN KEY (`bidan_id`) REFERENCES `bidan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penimbangan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_bidan_id_foreign` FOREIGN KEY (`bidan_id`) REFERENCES `bidan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_orangtua_id_foreign` FOREIGN KEY (`orangtua_id`) REFERENCES `orangtua` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
