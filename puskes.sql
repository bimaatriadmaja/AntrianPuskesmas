-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2025 at 03:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `puskes`
--

-- --------------------------------------------------------

--
-- Table structure for table `antrian`
--

CREATE TABLE `antrian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_antrian` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `poli` varchar(255) NOT NULL,
  `sesi` varchar(255) NOT NULL,
  `tgl_antrian` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`id`, `no_antrian`, `user_id`, `poli`, `sesi`, `tgl_antrian`, `created_at`, `updated_at`) VALUES
(1, 'U1', 4, 'umum', 'pagi', '2025-04-11', '2025-04-11 02:42:07', '2025-04-11 02:42:07'),
(2, 'G1', 4, 'gigi', 'pagi', '2025-04-13', '2025-04-13 05:35:54', '2025-04-13 05:35:54'),
(3, 'U1', 4, 'umum', 'pagi', '2025-04-25', '2025-04-25 00:53:10', '2025-04-25 00:53:10'),
(4, 'U2', 4, 'umum', 'pagi', '2025-04-25', '2025-04-25 01:27:46', '2025-04-25 01:27:46'),
(5, 'G1', 4, 'gigi', 'siang', '2025-04-25', '2025-04-25 01:30:16', '2025-04-25 01:30:16'),
(6, 'U3', 4, 'umum', 'sore', '2025-04-25', '2025-04-25 02:45:47', '2025-04-25 02:45:47'),
(7, 'U4', 4, 'umum', 'pagi', '2025-04-25', '2025-04-25 02:49:29', '2025-04-25 02:49:29'),
(8, 'G2', 4, 'gigi', 'pagi', '2025-04-25', '2025-04-25 02:51:03', '2025-04-25 02:51:03'),
(10, 'U6', 4, 'umum', 'pagi', '2025-04-25', '2025-04-25 11:03:30', '2025-04-25 11:03:30'),
(15, 'U7', 5, 'umum', 'pagi', '2025-04-25', '2025-04-25 11:28:36', '2025-04-25 11:28:36'),
(16, 'G3', 5, 'gigi', 'sore', '2025-04-25', '2025-04-25 11:28:47', '2025-04-25 11:28:47'),
(17, 'T1', 5, 'tht', 'pagi', '2025-04-25', '2025-04-25 11:31:42', '2025-04-25 11:31:42'),
(18, 'T2', 5, 'tht', 'siang', '2025-04-25', '2025-04-25 13:14:36', '2025-04-25 13:14:36');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_dokter`
--

CREATE TABLE `jadwal_dokter` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(255) NOT NULL,
  `nama_dokter` varchar(255) NOT NULL,
  `poli` enum('umum','gigi','tht','lansia & disabilitas','balita','kia & kb','nifas/pnc') NOT NULL,
  `sesi` enum('Pagi','Siang','Sore','Malam') NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal_dokter`
--

INSERT INTO `jadwal_dokter` (`id`, `nip`, `nama_dokter`, `poli`, `sesi`, `jam_mulai`, `jam_selesai`) VALUES
(1, '123001', 'Dr. Andi Wijaya', 'umum', 'Pagi', '07:00:00', '10:00:00'),
(2, '123002', 'Dr. Rani Susanti', 'gigi', 'Sore', '15:00:00', '18:00:00'),
(3, '123003', 'Dr. Budi Santoso', 'tht', 'Pagi', '08:00:00', '12:00:00'),
(4, '123004', 'Dr. Clara Dewi', 'lansia & disabilitas', 'Siang', '10:00:00', '14:00:00'),
(5, '123005', 'Dr. Eka Purnama', 'balita', 'Pagi', '09:00:00', '11:00:00'),
(6, '123006', 'Dr. Fahri Ananda', 'kia & kb', 'Siang', '13:00:00', '15:00:00'),
(7, '123007', 'Dr. Gina Maharani', 'nifas/pnc', 'Sore', '15:00:00', '17:10:00'),
(9, '12233445', 'Dr. Gita Salma Nela Diofani', 'kia & kb', 'Pagi', '07:30:00', '11:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_02_23_223804_create_roles_table', 1),
(6, '2025_02_23_223827_create_jadwal_dokter_table', 1),
(7, '2025_03_06_194826_create_antrian_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'dokter', '2025-04-11 02:37:07', '2025-04-11 02:37:07'),
(2, 'pasien', '2025-04-11 02:37:07', '2025-04-11 02:37:07'),
(3, 'admin', '2025-04-11 02:37:07', '2025-04-11 02:37:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `no_ktp` varchar(16) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role_id`, `tgl_lahir`, `alamat`, `jenis_kelamin`, `no_ktp`, `no_hp`, `pekerjaan`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '2025-04-11 02:37:07', '$2y$12$kq2vJBXfx.l8Yu.6UmJJ6uHMOL8fCWxgMb7Y6pQzz6DJsXVxeEOR6', 3, '1980-01-01', 'Kantor', 'laki-laki', '1234567890123456', '081234567890', 'Administrator', NULL, '2025-04-11 02:37:08', '2025-04-11 02:37:08'),
(4, 'Fitran Daffa', 'fitran@gmail.com', NULL, '$2y$12$MVI633OuQwAcVYLtrfgHLuc/do7GgLhWhAEhTGtUnFkj2syCOG0dO', 2, '2025-04-01', 'klaten', 'laki-laki', '1234567891234568', '085601939868', 'mahasiswa', NULL, '2025-04-11 02:41:09', '2025-04-11 02:41:09'),
(5, 'bima', 'bima@gmail.com', NULL, '$2y$12$Dc6ZExepB3gSdSRj3KZZbenVfDA3dVEaI/tUfhieZRomEkYMDQ1L.', 2, '2025-04-25', 'aaa', 'laki-laki', '2012910291029102', '121212121212', 'asasa', NULL, '2025-04-25 11:02:29', '2025-04-25 11:02:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `antrian_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jadwal_dokter_nip_unique` (`nip`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_no_ktp_unique` (`no_ktp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `antrian`
--
ALTER TABLE `antrian`
  ADD CONSTRAINT `antrian_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
