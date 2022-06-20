-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2022 at 02:45 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `nama`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin#gmail.com', '$2y$10$7w.glr9XHr06RhSM3jQLwu4xaGlCjPRLQiRVWcjy19M01bo6aeA7q', '2022-06-20 05:18:02', '2022-06-20 05:18:02');

-- --------------------------------------------------------

--
-- Table structure for table `alamats`
--

CREATE TABLE `alamats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `atas_nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail__transaksis`
--

CREATE TABLE `detail__transaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `jml_beli` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gambars`
--

CREATE TABLE `gambars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isCover` tinyint(1) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keranjangs`
--

CREATE TABLE `keranjangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `jml_beli` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(37, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(38, '2022_06_14_062344_create_users_table', 1),
(39, '2022_06_14_062437_create_admins_table', 1),
(40, '2022_06_14_062458_create_detail__transaksis_table', 1),
(41, '2022_06_14_062521_create_keranjangs_table', 1),
(42, '2022_06_14_062650_create_produks_table', 1),
(43, '2022_06_14_062710_create_transaksis_table', 1),
(44, '2022_06_15_103201_create_gambars_table', 1),
(45, '2022_06_19_080628_create_alamats_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produks`
--

CREATE TABLE `produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 1,
  `harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `alamat_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Gideon Swift', 'ethan48', 'krajcik.dagmar@example.org', '$2y$10$ntaUu2/9qbrf/x3eWsQb/eYsZ0yoB2ecenhboBc2U0kTNh2Yxinn.', '2022-06-20 05:18:01', '2022-06-20 05:18:01'),
(2, 'Norene Senger', 'spencer.misael', 'walsh.sydnie@example.com', '$2y$10$W.fM7qPcB6pAZqhQJywkRemfNNisIvZ9knder7EtgbcGObR.AHHZ2', '2022-06-20 05:18:01', '2022-06-20 05:18:01'),
(3, 'Lourdes Graham', 'ara.kertzmann', 'mhammes@example.org', '$2y$10$ROzdmA7la1xIkFWloGjrb.TyQJhTOf6RFTG2JcjoXr6Qa2sVP2f/e', '2022-06-20 05:18:01', '2022-06-20 05:18:01'),
(4, 'Joan Von II', 'burley35', 'hartmann.ivory@example.net', '$2y$10$Nx5MDnNVQPfx6F.l7EMShOIe6DnbE6CkHshTkk4YDuS1KL0RVBOYa', '2022-06-20 05:18:01', '2022-06-20 05:18:01'),
(5, 'Vivien Beatty', 'kautzer.clementina', 'nsanford@example.net', '$2y$10$29J8iXh5kEhKfhm2jAdSNeHT3YRcaGNStDkicAu.z5H9j3hXg30Tu', '2022-06-20 05:18:01', '2022-06-20 05:18:01'),
(6, 'Kacie Barton', 'sschulist', 'anika.maggio@example.org', '$2y$10$XnKWRXnYM2VbPfN6bcqCoeelWam1F7I.wSdJuGRyRvT9rQq9mHuJu', '2022-06-20 05:18:01', '2022-06-20 05:18:01'),
(7, 'Alayna Robel', 'twila61', 'brielle.oberbrunner@example.org', '$2y$10$l1V4FRmpigOFfi6i/I6P4u60IUc.YHJqMMPZIvUx3FDz30JBDd5aG', '2022-06-20 05:18:02', '2022-06-20 05:18:02'),
(8, 'Tatyana Schamberger DVM', 'issac92', 'hane.erwin@example.com', '$2y$10$G9Wap.lPElUQOwKuXoc5uOxnPtLYUBctdhKqlTbkkPTFWMu2P2oq6', '2022-06-20 05:18:02', '2022-06-20 05:18:02'),
(9, 'Mr. Stan Boyle', 'bernice.barrows', 'eloisa.johnson@example.org', '$2y$10$tXCqoIzujusbZuz6ywhTQ.H18vafAiL64Iof67qAHSx3CZLaAa/Ti', '2022-06-20 05:18:02', '2022-06-20 05:18:02'),
(10, 'Federico Treutel MD', 'cdibbert', 'mozell.stark@example.org', '$2y$10$YTIlgawvdR4Ko2PV9iUqKeIhaHajz/PuuPzc1HXjxYySKTuQbSFbS', '2022-06-20 05:18:02', '2022-06-20 05:18:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `alamats`
--
ALTER TABLE `alamats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail__transaksis`
--
ALTER TABLE `detail__transaksis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gambars`
--
ALTER TABLE `gambars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjangs`
--
ALTER TABLE `keranjangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alamats`
--
ALTER TABLE `alamats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail__transaksis`
--
ALTER TABLE `detail__transaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gambars`
--
ALTER TABLE `gambars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keranjangs`
--
ALTER TABLE `keranjangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
