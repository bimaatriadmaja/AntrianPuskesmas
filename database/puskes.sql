-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 28, 2025 at 05:15 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.12

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
  `id` bigint UNSIGNED NOT NULL,
  `no_antrian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `jadwal_dokter_id` bigint UNSIGNED NOT NULL,
  `tgl_antrian` date NOT NULL,
  `status` enum('ditunda','dipanggil','dibatalkan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ditunda',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`id`, `no_antrian`, `user_id`, `jadwal_dokter_id`, `tgl_antrian`, `status`, `created_at`, `updated_at`) VALUES
(1, 'N001', 3, 7, '2025-04-28', 'dipanggil', '2025-04-28 03:37:46', '2025-04-28 04:22:12'),
(2, 'K001', 3, 6, '2025-04-28', 'ditunda', '2025-04-28 03:48:07', '2025-04-28 03:48:07'),
(3, 'L001', 3, 4, '2025-04-28', 'ditunda', '2025-04-28 03:53:14', '2025-04-28 03:53:14'),
(4, 'A102', 1, 1, '2025-04-27', 'ditunda', '2025-04-28 04:21:24', '2025-04-28 04:21:24'),
(5, 'B203', 1, 1, '2025-04-26', 'dipanggil', '2025-04-28 04:21:24', '2025-04-28 04:21:24'),
(6, 'C304', 1, 1, '2025-04-21', 'dibatalkan', '2025-04-28 04:21:24', '2025-04-28 04:21:24'),
(7, 'U001', 3, 1, '2025-04-28', 'ditunda', '2025-04-28 04:25:57', '2025-04-28 04:25:57'),
(8, 'G001', 3, 2, '2025-04-28', 'ditunda', '2025-04-28 04:26:03', '2025-04-28 04:26:03'),
(9, 'T001', 3, 3, '2025-04-28', 'ditunda', '2025-04-28 04:26:09', '2025-04-28 04:26:09'),
(10, 'B001', 3, 5, '2025-04-28', 'ditunda', '2025-04-28 04:26:18', '2025-04-28 04:26:18'),
(11, 'B002', 2, 5, '2025-04-28', 'ditunda', '2025-04-28 04:38:59', '2025-04-28 04:38:59'),
(12, 'G002', 2, 2, '2025-04-28', 'ditunda', '2025-04-28 04:39:07', '2025-04-28 04:39:07');

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
-- Table structure for table `jadwal_dokter`
--

CREATE TABLE `jadwal_dokter` (
  `id` bigint UNSIGNED NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_dokter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poli` enum('umum','gigi','tht','lansia & disabilitas','balita','kia & kb','nifas/pnc') COLLATE utf8mb4_unicode_ci NOT NULL,
  `kuota` int NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal_dokter`
--

INSERT INTO `jadwal_dokter` (`id`, `nip`, `nama_dokter`, `poli`, `kuota`, `jam_mulai`, `jam_selesai`) VALUES
(1, '123001', 'Dr. Andi Wijaya', 'umum', 24, '07:00:00', '10:00:00'),
(2, '123002', 'Dr. Rani Susanti', 'gigi', 23, '15:00:00', '18:00:00'),
(3, '123003', 'Dr. Budi Santoso', 'tht', 24, '08:00:00', '12:00:00'),
(4, '123004', 'Dr. Clara Dewi', 'lansia & disabilitas', 24, '10:00:00', '14:00:00'),
(5, '123005', 'Dr. Eka Purnama', 'balita', 23, '09:00:00', '11:00:00'),
(6, '123006', 'Dr. Fahri Ananda', 'kia & kb', 24, '13:00:00', '15:00:00'),
(7, '123007', 'Dr. Gina Maharani', 'nifas/pnc', 24, '15:00:00', '17:00:00');

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
(50, '2014_10_12_000000_create_users_table', 1),
(51, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(52, '2019_08_19_000000_create_failed_jobs_table', 1),
(53, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(54, '2025_02_23_223804_create_roles_table', 1),
(55, '2025_02_23_223827_create_jadwal_dokter_table', 1),
(56, '2025_03_06_194826_create_antrian_table', 1);

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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'dokter', '2025-04-28 03:37:19', '2025-04-28 03:37:19'),
(2, 'pasien', '2025-04-28 03:37:19', '2025-04-28 03:37:19'),
(3, 'admin', '2025-04-28 03:37:19', '2025-04-28 03:37:19');

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
  `role_id` bigint UNSIGNED NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_ktp` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role_id`, `tgl_lahir`, `alamat`, `jenis_kelamin`, `no_ktp`, `no_hp`, `pekerjaan`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '2025-04-28 03:37:19', '$2y$12$uTJULbN9JI/1zRBTLCtPOORvhaeV3TjUrtU5KSAxLMMHwlqTcqORK', 3, '1980-01-01', 'Kantor', 'laki-laki', '1234567890123456', '081234567890', 'Administrator', NULL, '2025-04-28 03:37:19', '2025-04-28 03:37:19'),
(2, 'Adni Septi', 'adni@example.com', '2025-04-28 03:37:19', '$2y$12$lPmRi26HFWoHuK42AkyjsOoMxc9KVDzdsHz6bgqPLIvR3ugYmC05y', 2, '1995-05-15', 'Alamat Adni Septi', 'perempuan', '2345678901234567', '082345678901', 'Kasir Minimarket', NULL, '2025-04-28 03:37:19', '2025-04-28 03:37:19'),
(3, 'Fitran', 'fitran@gmail.com', '2025-04-28 03:37:19', '$2y$12$o8yzQvaT8Jolfc/cMgJVfuKpwEp/XaOXPCiX3I.m9LrSsQ/5svqAG', 2, '2000-08-13', 'Desa Gatak', 'laki-laki', '1233216968547854', '081564332794', 'DJ', NULL, '2025-04-28 03:37:20', '2025-04-28 03:37:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `antrian_user_id_foreign` (`user_id`),
  ADD KEY `antrian_jadwal_dokter_id_foreign` (`jadwal_dokter_id`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `antrian`
--
ALTER TABLE `antrian`
  ADD CONSTRAINT `antrian_jadwal_dokter_id_foreign` FOREIGN KEY (`jadwal_dokter_id`) REFERENCES `jadwal_dokter` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `antrian_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
