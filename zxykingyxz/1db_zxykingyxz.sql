-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 02, 2026 at 01:50 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `1db_zxykingyxz`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_baocao`
--

CREATE TABLE `table_baocao` (
  `id` int NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `contents` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_reports` int UNSIGNED DEFAULT NULL,
  `date_created` int UNSIGNED DEFAULT NULL,
  `date_update` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_congno`
--

CREATE TABLE `table_congno` (
  `id` int NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `loai` int UNSIGNED DEFAULT NULL,
  `debt_price` int DEFAULT NULL,
  `total_price` int UNSIGNED DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` int UNSIGNED DEFAULT NULL,
  `date_created` int UNSIGNED DEFAULT NULL,
  `date_update` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_ngansach`
--

CREATE TABLE `table_ngansach` (
  `id` int NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `price` int UNSIGNED DEFAULT NULL,
  `loai` int UNSIGNED DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` int UNSIGNED DEFAULT NULL,
  `date_created` int UNSIGNED DEFAULT NULL,
  `date_update` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_settings`
--

CREATE TABLE `table_settings` (
  `id` int NOT NULL,
  `settings` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_report` int UNSIGNED DEFAULT NULL,
  `date_created` int UNSIGNED DEFAULT NULL,
  `date_update` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `table_settings`
--

INSERT INTO `table_settings` (`id`, `settings`, `type`, `date_report`, `date_created`, `date_update`) VALUES
(7, '{\"chitieu_anuong_month\":3000000,\"chitieu_anuong_day\":90000,\"chitieu_muasam_month\":1000000,\"chitieu_sinhhoat_month\":1500000,\"thunhap_codinh_month\":7000000,\"tietkiem_month\":1500000,\"chitieulon\":200000}', 'ngan-sach', 1772298000, 1741517113, 1755143723);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_baocao`
--
ALTER TABLE `table_baocao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_congno`
--
ALTER TABLE `table_congno`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_ngansach`
--
ALTER TABLE `table_ngansach`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_settings`
--
ALTER TABLE `table_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_baocao`
--
ALTER TABLE `table_baocao`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `table_congno`
--
ALTER TABLE `table_congno`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `table_ngansach`
--
ALTER TABLE `table_ngansach`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=358;

--
-- AUTO_INCREMENT for table `table_settings`
--
ALTER TABLE `table_settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
