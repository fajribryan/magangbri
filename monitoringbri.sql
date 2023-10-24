-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2023 at 10:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monitoringbri`
--

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
-- Table structure for table `inventaris`
--

CREATE TABLE `inventaris` (
  `id` int(11) NOT NULL,
  `tid` varchar(100) NOT NULL,
  `merek_mesin` varchar(100) NOT NULL,
  `tipe_mesin` varchar(100) NOT NULL,
  `jenis_mesin` varchar(100) NOT NULL,
  `merek_cctv` varchar(100) NOT NULL,
  `merek_ups` varchar(100) NOT NULL,
  `vendor_slm_cctv` varchar(100) NOT NULL,
  `vendor_slm_ups` varchar(100) NOT NULL,
  `vendor_kebersihan` varchar(100) NOT NULL,
  `vendor_pjpur` varchar(100) NOT NULL,
  `cover` varchar(100) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `long` float NOT NULL,
  `lat` float NOT NULL,
  `jenis_lokasi` varchar(100) NOT NULL,
  `tipe_lokasi` varchar(100) NOT NULL,
  `kategori_lokasi` varchar(100) NOT NULL,
  `kategori_grup` varchar(100) NOT NULL,
  `nilai_sewa_tahunan` varchar(100) NOT NULL,
  `sewa_mulai` date NOT NULL,
  `sewa_akhir` date NOT NULL,
  `kode_kc` varchar(100) NOT NULL,
  `nama_kc` varchar(100) NOT NULL,
  `kode_uko` varchar(100) NOT NULL,
  `nama_uko` varchar(100) NOT NULL,
  `kode_ro` varchar(100) NOT NULL,
  `nama_ro` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventaris`
--

INSERT INTO `inventaris` (`id`, `tid`, `merek_mesin`, `tipe_mesin`, `jenis_mesin`, `merek_cctv`, `merek_ups`, `vendor_slm_cctv`, `vendor_slm_ups`, `vendor_kebersihan`, `vendor_pjpur`, `cover`, `lokasi`, `long`, `lat`, `jenis_lokasi`, `tipe_lokasi`, `kategori_lokasi`, `kategori_grup`, `nilai_sewa_tahunan`, `sewa_mulai`, `sewa_akhir`, `kode_kc`, `nama_kc`, `kode_uko`, `nama_uko`, `kode_ro`, `nama_ro`) VALUES
(1, '2001', 'toshiba', 'toshiba', 'asus', 'asus', 'asus', 'asus', 'asus', 'asus', 'asus', 'asus', 'bekasi', 12312, 3123, 'bekasi', 'bekasi', 'bekasi', 'bekasi', '2000000000000', '2023-10-01', '2023-10-31', '1231312', '312312', '312312', '3113', '31231', 'bekasi');

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
(1, '2014_10_12_000000_create_user_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `pn` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `perusahaan` varchar(255) NOT NULL,
  `tim` varchar(50) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `kode_kc` varchar(15) NOT NULL,
  `nama_kc` varchar(50) NOT NULL,
  `kode_uko` varchar(15) NOT NULL,
  `nama_uko` varchar(50) NOT NULL,
  `kode_ro` varchar(15) NOT NULL,
  `nama_ro` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `pn`, `password`, `perusahaan`, `tim`, `jabatan`, `kode_kc`, `nama_kc`, `kode_uko`, `nama_uko`, `kode_ro`, `nama_ro`) VALUES
(12, 'M Fajri Bryan Pratama', '2001', '$2y$10$z.DZYYjb41W.91r3T4KDJel39zf3PuzyI8lnMFph1a18nOP18WTCG', 'Bank BRI', 'DNR', 'Intern', 'bks123', 'Bekasi', 'bks123', 'Bekasi', 'bks123', 'Bekasi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventaris`
--
ALTER TABLE `inventaris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
