-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 31, 2024 at 07:04 PM
-- Server version: 10.6.15-MariaDB-cll-lve
-- PHP Version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipankmy_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id` char(36) NOT NULL,
  `periode_id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id`, `periode_id`, `user_id`, `created_at`, `updated_at`) VALUES
('0ad4ccc1-96ee-45e4-a1ea-86a1eb652b93', '5dd35696-794b-4198-af3a-64eb2b8bdccb', 'cfd932be-00d3-42c6-a471-ce70d22e6536', '2024-01-31 01:19:05', '2024-01-31 01:19:05'),
('23487b73-6296-4f26-b54f-9e62b8d890b4', '5dd35696-794b-4198-af3a-64eb2b8bdccb', 'f3e696bc-0076-4ae8-b210-64fc2aad9c1b', '2024-01-31 01:18:31', '2024-01-31 01:18:31'),
('6f0d0544-0555-4986-b904-172d1c2c921b', '5dd35696-794b-4198-af3a-64eb2b8bdccb', 'ce84d87b-666d-4594-b5cc-e8a113f0ba0d', '2024-01-31 01:18:51', '2024-01-31 01:18:51'),
('eb7c087f-769b-4a44-a46a-9afaaf527972', '5dd35696-794b-4198-af3a-64eb2b8bdccb', 'e1b934c7-3215-48a4-956f-f74ac7bca072', '2024-01-31 04:31:17', '2024-01-31 04:31:17');

-- --------------------------------------------------------

--
-- Table structure for table `arsip`
--

CREATE TABLE `arsip` (
  `id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `berkas` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `arsip`
--

INSERT INTO `arsip` (`id`, `user_id`, `nama`, `berkas`, `created_at`, `updated_at`) VALUES
('3694499a-662e-4b0b-b95a-2efc9a11a3bf', 'ce84d87b-666d-4594-b5cc-e8a113f0ba0d', 'a', '1706699991-WNn5xlYt3T.pdf', '2024-01-31 04:19:51', '2024-01-31 04:19:51'),
('677d7743-23e8-47a7-b2cb-6d9847edeba4', 'f3e696bc-0076-4ae8-b210-64fc2aad9c1b', 'Tessa', '1706692148-niLSXb8ow3.pdf', '2024-01-31 02:09:08', '2024-01-31 02:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `berkas`
--

CREATE TABLE `berkas` (
  `id` char(36) NOT NULL,
  `periode_id` char(36) NOT NULL,
  `alternatif_id` char(36) NOT NULL,
  `surat_pengantar_instansi` varchar(255) DEFAULT NULL,
  `sk_cpns_pns` varchar(255) DEFAULT NULL,
  `kartu_pegawai` varchar(255) DEFAULT NULL,
  `skp` varchar(255) DEFAULT NULL,
  `sk_pangkat_akhir` varchar(255) DEFAULT NULL,
  `sk_jabatan_akhir` varchar(255) DEFAULT NULL,
  `ijazah` varchar(255) DEFAULT NULL,
  `sk_kp` varchar(255) DEFAULT NULL,
  `status` enum('dikirim','perbaikan','diterima') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `berkas`
--

INSERT INTO `berkas` (`id`, `periode_id`, `alternatif_id`, `surat_pengantar_instansi`, `sk_cpns_pns`, `kartu_pegawai`, `skp`, `sk_pangkat_akhir`, `sk_jabatan_akhir`, `ijazah`, `sk_kp`, `status`, `created_at`, `updated_at`) VALUES
('03a2afba-c48e-4a8a-b924-d134ad100848', '55a94d1b-2aa3-4815-9d3d-665ca124dc85', '326f07c0-7a95-4ddc-9ab7-626867ba3471', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-22 21:02:52', '2024-01-22 21:02:52'),
('44ec0874-1152-4ed7-9e05-05a2a4ced186', '3683cc3e-1c74-4b39-b1f2-ae8700862365', '7adf3fd7-5534-483a-9f6a-6fe7bfba5d68', 'Pas foto Yesaya.pdf---1700644253-3ZzGc3Sssn.pdf', 'Pas foto Yesaya.pdf---1700644253-nKc7CUqqCy.pdf', 'Pas foto Yesaya.pdf---1700644253-w8UwFrG0ld.pdf', 'Pas foto Yesaya.pdf---1700644253-9HixdRKead.pdf', 'Pas foto Yesaya.pdf---1700644253-maU44SQHHe.pdf', 'Pas foto Yesaya.pdf---1700644253-LlUbundRQy.pdf', 'Pas foto Yesaya.pdf---1700644253-tAwaY1IaWa.pdf', NULL, 'dikirim', '2023-11-22 01:08:40', '2023-11-22 01:10:53'),
('4ddd7dfa-c445-44b0-9c87-12bbf0c1d9c3', 'cd980d13-c884-4bb2-9293-5d583a032db0', '8de9f5e7-ebd8-4b3c-9772-9b7cc46a51ae', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-31 00:22:28', '2024-01-31 00:22:28'),
('52f88a84-8129-4ac5-9b02-89e7ebb3b97b', '5dd35696-794b-4198-af3a-64eb2b8bdccb', 'eb7c087f-769b-4a44-a46a-9afaaf527972', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-31 04:31:17', '2024-01-31 04:31:17'),
('9a94a936-7615-4b54-ba70-a2ea084175f5', '5dd35696-794b-4198-af3a-64eb2b8bdccb', '23487b73-6296-4f26-b54f-9e62b8d890b4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-31 01:18:31', '2024-01-31 01:18:31'),
('c0df2c3d-6ff4-49bb-97f4-d5c16b1199a6', '5dd35696-794b-4198-af3a-64eb2b8bdccb', '0ad4ccc1-96ee-45e4-a1ea-86a1eb652b93', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-31 01:19:05', '2024-01-31 01:19:05'),
('d7f9d35c-4490-4f8a-9e54-908295536733', '5dd35696-794b-4198-af3a-64eb2b8bdccb', '6f0d0544-0555-4986-b904-172d1c2c921b', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-31 01:18:51', '2024-01-31 01:18:51'),
('ed0f649c-6db3-42a4-992c-bab086bc0cfe', 'a9a935be-9d93-4bff-af31-70c7fcaf18dd', '42340056-27f0-4991-a9ad-51459bd540ba', 'Pas foto Yesaya.pdf---1699514618-6Z0LeIqTzL.pdf', 'Pas foto Yesaya.pdf---1699514618-naRqe6lE20.pdf', 'Pas foto Yesaya.pdf---1699514618-i44QSgn3kr.pdf', 'Pas foto Yesaya.pdf---1699514618-WpGDYEGrOB.pdf', 'Pas foto Yesaya.pdf---1699514618-kDIEFvVjzn.pdf', 'Pas foto Yesaya.pdf---1699514618-5sosXPdtAD.pdf', 'Pas foto Yesaya.pdf---1699514618-OeIxvgIb46.pdf', NULL, 'dikirim', '2023-11-08 22:16:01', '2023-11-08 23:23:38');

-- --------------------------------------------------------

--
-- Table structure for table `bobot_kriteria`
--

CREATE TABLE `bobot_kriteria` (
  `id` char(36) NOT NULL,
  `kriteria1` int(11) NOT NULL,
  `kriteria2` int(11) NOT NULL,
  `bobot` double NOT NULL DEFAULT 0,
  `eigen` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bobot_kriteria`
--

INSERT INTO `bobot_kriteria` (`id`, `kriteria1`, `kriteria2`, `bobot`, `eigen`, `created_at`, `updated_at`) VALUES
('1929eaee-90cf-414e-9af7-51e57e2e6108', 1, 2, 3, 0.75, '2023-11-08 21:49:21', '2023-11-08 21:50:24'),
('268e3575-bcc1-41c7-a6ff-97d826342419', 1, 1, 1, 0.75, '2023-11-08 21:48:11', '2023-11-08 21:50:24'),
('d34b2c5a-b61d-4e7b-b727-fc09c9411252', 2, 2, 1, 0.25, '2023-11-08 21:49:21', '2023-11-08 21:50:24'),
('edb6272b-edbb-47da-b718-e7572acda1fd', 2, 1, 0.33333333333333, 0.25, '2023-11-08 21:49:21', '2023-11-08 21:50:24');

-- --------------------------------------------------------

--
-- Table structure for table `bobot_subkriteria`
--

CREATE TABLE `bobot_subkriteria` (
  `id` char(36) NOT NULL,
  `kriteria_id` char(36) NOT NULL,
  `subkriteria_id` char(36) NOT NULL,
  `kriteria1` int(11) NOT NULL,
  `kriteria2` int(11) NOT NULL,
  `bobot` double NOT NULL DEFAULT 0,
  `eigen` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bobot_subkriteria`
--

INSERT INTO `bobot_subkriteria` (`id`, `kriteria_id`, `subkriteria_id`, `kriteria1`, `kriteria2`, `bobot`, `eigen`, `created_at`, `updated_at`) VALUES
('14cc6300-496a-4874-9fd0-0fcec60253a3', '7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f', 'b3fb1ffb-f0c4-497c-a808-1d12837f9246', 3, 3, 1, 0.10714285714286, '2023-11-08 21:55:26', '2023-11-08 22:04:27'),
('1728ecce-6114-4fa7-ae97-7710ef348e0e', '7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f', 'e17f32ba-4981-4801-9cfa-aea4cc6dfd19', 2, 2, 1, 0.22058823529412, '2023-11-08 21:55:07', '2023-11-08 22:04:27'),
('1744e662-b42f-4e1f-aaa7-f36330301736', 'e830576e-591e-4d01-8ebf-0ce28185e501', '37a2340e-e13e-4682-956e-cbed14cfdb1a', 5, 8, 7, 0.4375, '2023-11-08 21:59:25', '2023-11-08 22:09:20'),
('2463da3f-1e65-4f8f-a5b7-03e85c12720b', '7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f', '672abd5d-14dd-4738-82f6-d4db81defaa6', 4, 3, 0.33333333333333, 0.035714285714285, '2023-11-08 21:55:44', '2023-11-08 22:04:27'),
('270fb4ff-b9e1-4087-8a37-167c70308844', 'e830576e-591e-4d01-8ebf-0ce28185e501', '37a2340e-e13e-4682-956e-cbed14cfdb1a', 5, 5, 1, 0.59659090909091, '2023-11-08 21:57:25', '2023-11-08 22:09:20'),
('316f67e7-e965-4d5a-a417-6b09377f0398', 'e830576e-591e-4d01-8ebf-0ce28185e501', 'd024f740-7af0-44f3-8e7c-5ec53c3a0b1f', 8, 6, 0.2, 0.044117647058824, '2023-11-08 21:59:25', '2023-11-08 22:09:20'),
('326a5e30-f036-4d5d-9f15-2b2160e00f9d', '7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f', 'e17f32ba-4981-4801-9cfa-aea4cc6dfd19', 2, 4, 5, 0.3125, '2023-11-08 21:55:44', '2023-11-08 22:04:27'),
('35d1191c-f2cb-4a26-b38a-391132813d9c', '7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f', 'b3fb1ffb-f0c4-497c-a808-1d12837f9246', 3, 4, 3, 0.1875, '2023-11-08 21:55:44', '2023-11-08 22:04:27'),
('386cdb59-3900-47f7-b202-34522b21ab13', 'e830576e-591e-4d01-8ebf-0ce28185e501', 'd024f740-7af0-44f3-8e7c-5ec53c3a0b1f', 8, 7, 0.33333333333333, 0.035714285714285, '2023-11-08 21:59:25', '2023-11-08 22:09:20'),
('445e5b8b-d0c1-4b84-9fe4-90d089516646', 'e830576e-591e-4d01-8ebf-0ce28185e501', '99fe40d8-c78d-494c-9118-029c9610888a', 7, 6, 0.33333333333333, 0.073529411764705, '2023-11-08 21:58:49', '2023-11-08 22:09:20'),
('5b552de2-331b-43a0-a2c9-a9a173866287', '7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f', '672abd5d-14dd-4738-82f6-d4db81defaa6', 4, 4, 1, 0.0625, '2023-11-08 21:55:44', '2023-11-08 22:04:27'),
('65bd89ae-730f-43b3-842f-07337bd80494', 'e830576e-591e-4d01-8ebf-0ce28185e501', '37a2340e-e13e-4682-956e-cbed14cfdb1a', 5, 6, 3, 0.66176470588235, '2023-11-08 21:58:15', '2023-11-08 22:09:20'),
('6b8eb4d9-384e-4674-b0b7-ebce0a310f8f', 'e830576e-591e-4d01-8ebf-0ce28185e501', 'd024f740-7af0-44f3-8e7c-5ec53c3a0b1f', 8, 5, 0.14285714285714, 0.085227272727271, '2023-11-08 21:59:25', '2023-11-08 22:09:20'),
('817a46af-2131-481f-8f3a-dbc7329e6882', '7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f', '8680423c-d029-4645-b532-9d809af606e3', 1, 1, 1, 0.59659090909091, '2023-11-08 21:54:40', '2023-11-08 22:04:27'),
('86987d70-3da0-40c8-93c4-f4ea6d17b61a', '7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f', 'b3fb1ffb-f0c4-497c-a808-1d12837f9246', 3, 1, 0.2, 0.11931818181818, '2023-11-08 21:55:26', '2023-11-08 22:04:27'),
('86cd3b2c-f05a-4b48-b32e-0555d6ece0af', 'e830576e-591e-4d01-8ebf-0ce28185e501', '99fe40d8-c78d-494c-9118-029c9610888a', 7, 8, 3, 0.1875, '2023-11-08 21:59:25', '2023-11-08 22:09:20'),
('8e2cd357-4d5f-4aba-8f67-e91ec8984b9d', '7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f', '8680423c-d029-4645-b532-9d809af606e3', 1, 2, 3, 0.66176470588235, '2023-11-08 21:55:07', '2023-11-08 22:04:27'),
('8f18ed27-226c-4dff-a8b1-7e41098ee382', 'e830576e-591e-4d01-8ebf-0ce28185e501', 'a3e44379-2200-48fc-8abe-de688291fa62', 6, 5, 0.33333333333333, 0.19886363636364, '2023-11-08 21:58:15', '2023-11-08 22:09:20'),
('a1fca053-af53-4e1d-8be7-90f417c4da77', '7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f', 'e17f32ba-4981-4801-9cfa-aea4cc6dfd19', 2, 1, 0.33333333333333, 0.19886363636364, '2023-11-08 21:55:07', '2023-11-08 22:04:27'),
('a809bc6a-478f-4a16-aaf2-fd38b54f9697', '7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f', '672abd5d-14dd-4738-82f6-d4db81defaa6', 4, 1, 0.14285714285714, 0.085227272727271, '2023-11-08 21:55:44', '2023-11-08 22:04:27'),
('b261b14f-3e3c-4fce-baf6-d97e3b2b96c8', 'e830576e-591e-4d01-8ebf-0ce28185e501', 'd024f740-7af0-44f3-8e7c-5ec53c3a0b1f', 8, 8, 1, 0.0625, '2023-11-08 21:59:25', '2023-11-08 22:09:20'),
('bd34602c-16e7-4bee-a04e-e762cc721c20', 'e830576e-591e-4d01-8ebf-0ce28185e501', 'a3e44379-2200-48fc-8abe-de688291fa62', 6, 6, 1, 0.22058823529412, '2023-11-08 21:58:15', '2023-11-08 22:09:20'),
('c1f03607-9833-45e9-b9a9-a28778865d0c', '7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f', '8680423c-d029-4645-b532-9d809af606e3', 1, 3, 5, 0.53571428571429, '2023-11-08 21:55:26', '2023-11-08 22:04:27'),
('c2fb6096-750a-4fae-a131-108f8f754a82', 'e830576e-591e-4d01-8ebf-0ce28185e501', 'a3e44379-2200-48fc-8abe-de688291fa62', 6, 7, 3, 0.32142857142857, '2023-11-08 21:58:49', '2023-11-08 22:09:20'),
('c42200dc-f0cc-49b7-91ef-32f57dd46711', '7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f', 'e17f32ba-4981-4801-9cfa-aea4cc6dfd19', 2, 3, 3, 0.32142857142857, '2023-11-08 21:55:26', '2023-11-08 22:04:27'),
('ce7a4ff8-7c3e-4958-b370-07febf0c2709', 'e830576e-591e-4d01-8ebf-0ce28185e501', '37a2340e-e13e-4682-956e-cbed14cfdb1a', 5, 7, 5, 0.53571428571429, '2023-11-08 21:58:49', '2023-11-08 22:09:20'),
('ce88dc50-d538-4018-a39f-72cb2d02fd52', 'e830576e-591e-4d01-8ebf-0ce28185e501', 'a3e44379-2200-48fc-8abe-de688291fa62', 6, 8, 5, 0.3125, '2023-11-08 21:59:25', '2023-11-08 22:09:20'),
('d366a14a-15b8-41e8-91e3-8dd97a2cf475', 'e830576e-591e-4d01-8ebf-0ce28185e501', '99fe40d8-c78d-494c-9118-029c9610888a', 7, 5, 0.2, 0.11931818181818, '2023-11-08 21:58:49', '2023-11-08 22:09:20'),
('d92afc14-af8c-419e-b53d-57fd81382ae4', '7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f', 'b3fb1ffb-f0c4-497c-a808-1d12837f9246', 3, 2, 0.33333333333333, 0.073529411764705, '2023-11-08 21:55:26', '2023-11-08 22:04:27'),
('dfafcbf5-0847-4ce3-b786-32ebf37f9c6d', '7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f', '672abd5d-14dd-4738-82f6-d4db81defaa6', 4, 2, 0.2, 0.044117647058824, '2023-11-08 21:55:44', '2023-11-08 22:04:27'),
('ef203157-6ac3-4fa1-ba43-6cbb82980b97', 'e830576e-591e-4d01-8ebf-0ce28185e501', '99fe40d8-c78d-494c-9118-029c9610888a', 7, 7, 1, 0.10714285714286, '2023-11-08 21:58:49', '2023-11-08 22:09:20'),
('f4df5352-38d1-4243-8f46-af20ed29e73b', '7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f', '8680423c-d029-4645-b532-9d809af606e3', 1, 4, 7, 0.4375, '2023-11-08 21:55:44', '2023-11-08 22:04:27');

-- --------------------------------------------------------

--
-- Table structure for table `detail_alternatif`
--

CREATE TABLE `detail_alternatif` (
  `id` char(36) NOT NULL,
  `alternatif_id` char(36) NOT NULL,
  `kriteria_id` char(36) DEFAULT NULL,
  `nama_kriteria` varchar(255) DEFAULT NULL,
  `subkriteria_id` char(36) DEFAULT NULL,
  `nama_subkriteria` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_alternatif`
--

INSERT INTO `detail_alternatif` (`id`, `alternatif_id`, `kriteria_id`, `nama_kriteria`, `subkriteria_id`, `nama_subkriteria`, `created_at`, `updated_at`) VALUES
('15c95e16-f078-43da-ab2c-203c8fbf8238', '0ad4ccc1-96ee-45e4-a1ea-86a1eb652b93', 'e830576e-591e-4d01-8ebf-0ce28185e501', 'Kinerja Pegawai', '37a2340e-e13e-4682-956e-cbed14cfdb1a', 'Baik (90-100)', '2024-01-31 01:19:05', '2024-01-31 01:19:05'),
('37ce038e-e890-49cc-9b8b-cfcfa33492fc', '6f0d0544-0555-4986-b904-172d1c2c921b', '7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f', 'Lamanya Masa Kerja', 'b3fb1ffb-f0c4-497c-a808-1d12837f9246', 'Lama(1-2 Tahun)', '2024-01-31 01:18:51', '2024-01-31 01:18:51'),
('55d10c03-6b6e-41d5-93ed-dd130b4ddc51', '23487b73-6296-4f26-b54f-9e62b8d890b4', '7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f', 'Lamanya Masa Kerja', '8680423c-d029-4645-b532-9d809af606e3', 'Sangat Lama (>3 Tahun)', '2024-01-31 01:18:31', '2024-01-31 01:18:31'),
('7584cec6-568b-4287-bac5-0bd16827e86c', 'eb7c087f-769b-4a44-a46a-9afaaf527972', '7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f', 'Lamanya Masa Kerja', '8680423c-d029-4645-b532-9d809af606e3', 'Sangat Lama (>3 Tahun)', '2024-01-31 04:31:17', '2024-01-31 04:31:17'),
('95edbf4e-2f14-4e58-8d0e-d44c3d473de8', '23487b73-6296-4f26-b54f-9e62b8d890b4', 'e830576e-591e-4d01-8ebf-0ce28185e501', 'Kinerja Pegawai', 'a3e44379-2200-48fc-8abe-de688291fa62', 'Cukup (70-89)', '2024-01-31 01:18:31', '2024-01-31 01:18:31'),
('9cf49937-8d98-43a0-9217-bd07e5011c79', '0ad4ccc1-96ee-45e4-a1ea-86a1eb652b93', '7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f', 'Lamanya Masa Kerja', '8680423c-d029-4645-b532-9d809af606e3', 'Sangat Lama (>3 Tahun)', '2024-01-31 01:19:05', '2024-01-31 01:19:05'),
('affbd989-5126-48cf-9641-ace40e3b0c25', 'eb7c087f-769b-4a44-a46a-9afaaf527972', 'e830576e-591e-4d01-8ebf-0ce28185e501', 'Kinerja Pegawai', 'a3e44379-2200-48fc-8abe-de688291fa62', 'Cukup (70-89)', '2024-01-31 04:31:17', '2024-01-31 04:31:17'),
('d9f5a9ee-4f8b-4314-a350-d9dd1a4078c8', '6f0d0544-0555-4986-b904-172d1c2c921b', 'e830576e-591e-4d01-8ebf-0ce28185e501', 'Kinerja Pegawai', 'a3e44379-2200-48fc-8abe-de688291fa62', 'Cukup (70-89)', '2024-01-31 01:18:51', '2024-01-31 01:18:51');

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
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` char(36) NOT NULL,
  `kode` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jumlah_bobot` double NOT NULL DEFAULT 0,
  `jumlah_eigen` double NOT NULL DEFAULT 0,
  `rata_eigen` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `kode`, `nama`, `jumlah_bobot`, `jumlah_eigen`, `rata_eigen`, `created_at`, `updated_at`) VALUES
('7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f', 1, 'Lamanya Masa Kerja', 1.3333333333333, 1.5, 0.75, '2023-11-08 21:48:11', '2023-11-08 21:50:24'),
('e830576e-591e-4d01-8ebf-0ce28185e501', 2, 'Kinerja Pegawai', 4, 0.5, 0.25, '2023-11-08 21:49:21', '2023-11-08 21:50:24');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_08_08_154847_create_kriterias_table', 1),
(6, '2023_08_08_154914_create_bobot_kriterias_table', 1),
(7, '2023_08_10_135226_create_sub_kriterias_table', 1),
(8, '2023_08_10_135502_create_bobot_subkriterias_table', 1),
(13, '2023_08_13_063452_create_periode_naik_pangkats_table', 3),
(21, '2023_08_14_111326_create_alternatifs_table', 5),
(23, '2023_08_14_133548_create_detail_alternatifs_table', 6),
(25, '2023_08_16_035307_create_perankingans_table', 7),
(26, '2023_08_21_144910_create_berkas_table', 8),
(27, '2023_08_24_104210_create_peninjauan_berkas_table', 9),
(28, '2023_08_30_100745_create_pemberitahuans_table', 10),
(29, '2023_09_07_134728_create_arsips_table', 11),
(30, '2014_10_12_000000_create_users_table', 12),
(31, '2023_08_13_041729_create_pegawais_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `nipl` varchar(255) DEFAULT NULL,
  `gelar_depan` varchar(255) DEFAULT NULL,
  `gelar_belakang` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `gol_darah` enum('A','B','AB','O') DEFAULT NULL,
  `identitas_diri` enum('KTP','SIM','Paspor') DEFAULT NULL,
  `nomor_identitas` varchar(255) DEFAULT NULL,
  `npwp` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kelurahan_desa` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `kab_kota` varchar(255) DEFAULT NULL,
  `kode_pos` varchar(255) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `agama` enum('Islam','Kristen','Katholik','Hindu','Budha') DEFAULT NULL,
  `status_pernikahan` enum('Singel','Menikah','Janda','Duda') DEFAULT NULL,
  `tinggi` varchar(255) DEFAULT NULL,
  `berat_badan` varchar(255) DEFAULT NULL,
  `hobi` varchar(255) DEFAULT NULL,
  `tmt_bekerja_cpns` date DEFAULT NULL,
  `tmt_sk_akhir` date DEFAULT NULL,
  `gol_ruang_awal` varchar(255) DEFAULT NULL,
  `nilai_skp` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `user_id`, `jabatan`, `nipl`, `gelar_depan`, `gelar_belakang`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `gol_darah`, `identitas_diri`, `nomor_identitas`, `npwp`, `alamat`, `kelurahan_desa`, `kecamatan`, `kab_kota`, `kode_pos`, `no_telp`, `agama`, `status_pernikahan`, `tinggi`, `berat_badan`, `hobi`, `tmt_bekerja_cpns`, `tmt_sk_akhir`, `gol_ruang_awal`, `nilai_skp`, `created_at`, `updated_at`) VALUES
('050be5cf-8408-4cc3-bc83-8ddf9d2aa294', '139e6eeb-421a-48dd-addd-d5afeac16531', 'Pegawai', '123', '123', '123', '123', '2023-10-12', 'L', 'A', 'KTP', '123', '123', '123', '123', '123', '123', '123', '123', 'Kristen', 'Singel', '123', '123', '12', '2023-10-12', NULL, '123', NULL, '2023-09-30 06:39:07', '2023-10-12 02:49:02'),
('0941d5da-b5e7-4ffb-a287-000cc3c43e3d', 'ca4993b8-7d27-4c61-9da2-517372376dc6', 'Pengadministrasi Perkantoran', '560 017 039', '-', '-', 'Tondano', '1973-04-02', 'P', 'A', 'KTP', '7102201420470001', '55.205.638.4-823.000', 'Lingkungan 1', 'Kelurahan Sasaran', 'Tondano Utara', 'Minahasa', '95616', '0853 9854 6822', 'Kristen', 'Menikah', '160', '80', 'Membaca', '2002-12-01', '2020-10-01', 'lll/d', 90, '2023-11-20 21:40:44', '2023-11-21 02:16:57'),
('0e1b1fa8-d2c8-41d4-9a24-39344a4afc64', '819b13d8-a9d2-49f7-aef3-ab75528931b6', '123', '4444', '-', 'S.Kom', 'Lahendong', '2001-12-30', 'P', 'AB', 'Paspor', '122222', '12555', 'Lahendong', 'Lahendong', 'Tomohon', 'Tomohon', '96564', '000', 'Kristen', 'Menikah', '111', '56', 'hh', '2018-01-30', '2020-01-01', 'dd', 75, '2023-11-18 23:03:50', '2023-11-19 02:35:44'),
('16a5228f-01c5-488e-9727-910d9e068e30', 'ea903916-2132-4904-b678-d1847fb53105', 'asasda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-12 02:52:31', '2023-10-12 02:52:31'),
('1860668f-f996-48c5-9ec5-ef23f2f5cb23', '666ac4f2-d0b6-45b4-8da8-8a9cfec77cc5', 'Pegawai', '111', '111', '111', '111', '2023-10-12', 'L', 'A', 'KTP', '111', '111', '111', '111', '111', '111', '111', '111', 'Kristen', 'Singel', '111', '111', '111', '2023-10-12', '2023-11-08', '111', NULL, '2023-10-12 02:45:21', '2023-11-07 22:45:53'),
('1c72ef9f-7d13-4a00-94ff-c68c12bcf409', 'cc08f2cf-da4c-4e32-9139-2d33f0025720', 'czxcz', 'sd', 'dsf', 'dd', 'dsd', '2001-12-30', 'P', 'AB', 'Paspor', '545454', 'zzzzz', 'ccccc', 'xcxcx', 'aaa', 'bbb', 'zzzzaa', 'sssss', 'Hindu', 'Duda', 'ffff', 'bbbb', 'xxxxx', '2001-12-30', '2020-10-01', 'vvvnlkkk', 90, '2023-09-30 20:39:00', '2023-11-19 02:42:31'),
('205d60b3-ab0b-449b-ac74-54f0b95e157e', 'e6c3c8c4-9bb4-4170-b630-9aad878e2ae6', 'Pengendali Dampak Lingkungan Muda', '-', '-', 'SE', 'Motoling', '1974-12-31', 'L', 'O', 'KTP', '-', '-', '-', '-', '-', '-', '-', '-', 'Kristen', 'Menikah', '-', '-', '-', '1997-03-01', '0216-04-01', 'III/d', 89, '2023-11-20 22:18:00', '2024-01-31 00:35:33'),
('2edb8901-d929-42bc-ac5f-5ac2185769c7', '434f5c67-d763-4568-84d9-94bdb70785b1', 'Pengendali Dampak Lingkungan Muda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-20 22:21:48', '2023-11-20 22:21:48'),
('304cabea-1c85-4fdf-b5a5-f4e2871b83c9', '2fd77034-9941-4b44-8ff8-3181a57476fa', 'Bendahara', '560 020 838', '-', 'SE', 'Tondano', '1977-11-06', 'L', 'O', 'KTP', '7102010611770001', '16.617.851.7-823.000', 'Lingkungan II', 'Kelurahan Tounkuramber', 'Tondano Barat', 'Minahasa', '95616', '0852 4011 8011', 'Kristen', 'Menikah', '164', '72', 'Membaca dan Olahraga', '2006-04-01', '2010-04-01', 'III/a', 90, '2023-11-20 21:46:13', '2023-11-21 02:25:03'),
('41e6245f-77ca-4dc7-a7a4-b6a2659df8e3', '3f567902-40b5-429f-87b9-27ab0ab3bf6c', 'KABID Pengendalian Pencemaran dan Kerusakan LH', '-', '-', 'SP; MSi', 'Manado', '1972-02-05', 'P', 'O', 'KTP', '-', '-', '-', '-', '-', '-', '-', '-', 'Kristen', 'Menikah', '-', '-', '-', '1996-03-01', '2008-04-01', 'IV/a', 90, '2023-11-20 22:50:09', '2024-01-31 00:54:31'),
('4da8632a-3a0a-447c-8aca-1ef0323e7634', '5c10d177-a69d-4f48-9bf1-72e1d7d76686', 'test', '-', '-', '-', '-', '2001-12-30', 'P', 'AB', 'Paspor', '-', '-', '-', '-', '-', '-', '-', '-', 'Kristen', 'Singel', '150', '45', 'olahraga', '2005-11-10', '2020-04-01', '-', 90, '2023-11-22 01:01:49', '2023-11-22 20:56:15'),
('50284259-1a41-4699-ac27-b393594d76bd', 'e1b934c7-3215-48a4-956f-f74ac7bca072', 'Kasubang Program Keuangan dan Pelaporan', '-', '-', 'SIP', 'Tondano', '1966-01-09', 'L', 'O', 'KTP', '-', '-', '-', '--', '-', '-', '-', '-', 'Kristen', 'Menikah', '-', '-', '-', '1994-01-01', '2016-04-01', 'III/d', 75, '2023-11-20 22:26:01', '2024-01-31 01:02:13'),
('7005f38d-89d1-4833-8f0f-83617b40cdde', 'f3e696bc-0076-4ae8-b210-64fc2aad9c1b', 'Test 2', '-', '--', '-', '-', '1984-02-25', 'L', 'B', 'KTP', '-', '-', '-', '-', '-', '-', '-', '-', 'Kristen', 'Menikah', '-', '-', '-', '2006-04-01', '2019-04-01', '-', 88, '2024-01-31 01:10:56', '2024-01-31 01:18:07'),
('8549dc26-d06d-460f-9c8e-e13012474016', '11296481-31bb-4ca5-81d6-53b9a2634d33', 'SEKERTARIS', '-', '-', 'ST', '-', '0001-01-01', 'L', 'O', 'SIM', '-', '-', '-', '-', '-', '-', '-', '-', 'Kristen', 'Menikah', '-', '-', '-', '1998-03-01', '2020-04-01', 'IV/a', 90, '2023-11-20 22:51:39', '2023-11-21 02:32:54'),
('8ec29c09-7719-4eb6-9e72-177a88f7c55f', '7238210b-cd11-4d7e-9b70-765d83a78cc2', 'Pengawas Lingkungan Hidup Mudah', '-', '-', 'SH', 'Tondano', '1981-01-23', 'P', 'B', 'KTP', '-', '-', '-', '-', '-', '-', '-', '-', 'Kristen', 'Menikah', '-', '-', '-', '2002-12-01', '2012-10-01', 'III/d', 89, '2023-11-20 22:32:07', '2024-01-31 00:55:51'),
('955ca7d4-4bbd-4d14-9c23-b6cb5bd55178', '64e50665-9913-46ed-99ed-9dc95f15f8bb', 'Kabid Penataan dan Penataan', '-', '-', 'SE', 'Tondano', '1968-11-02', 'P', 'O', 'KTP', '-', '-', '-', '-', '-', '-', '-', '-', 'Kristen', 'Menikah', '-', '-', '-', '1996-03-01', '2021-10-01', 'IV/a', 90, '2023-11-20 22:46:18', '2024-01-31 00:54:57'),
('9686ac15-eb8f-4d52-bc27-168155959cf0', 'f008b890-c2f7-42cf-abf8-6304c27791f7', 'Pengendali Dampak Lingkungan Muda', '-', '-', 'S.Sos', '-', '0001-01-01', 'L', 'O', 'KTP', '-', '-', '-', '-', '-', '-', '-', '-', 'Kristen', 'Menikah', '-', '-', '-', '2014-08-01', '2023-10-01', 'III/c', 94, '2023-11-20 22:09:15', '2023-11-21 03:12:07'),
('98e422b4-3fe5-428e-973b-bc134a8e7822', 'ce84d87b-666d-4594-b5cc-e8a113f0ba0d', 'test', '4444', '-', 'S.Kom', 'Teep', '1983-12-30', 'P', 'O', 'KTP', '712055', '2', 'Tataaran Patar', 'teep', 'Langowan Timur', 'Tondano', '95616', '089698827590', 'Kristen', 'Singel', '160', '53', 'Membaca', '2009-10-30', '2023-01-10', '-', 80, '2024-01-22 20:59:50', '2024-01-31 01:15:10'),
('9c21b2b5-a527-4b27-8daa-6a52b87a4ca0', '15b2709c-8438-4352-b88b-836d76914411', 'Pengendali Dampak Lingkungan Muda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-20 22:15:18', '2023-11-20 22:15:18'),
('9e67dc92-dcc4-4904-87cf-bab7eeca8b3c', 'a2d009ca-94a2-4ce9-86f0-979cdc1bbaeb', 'KEPALA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-20 22:52:58', '2023-11-20 22:52:58'),
('a7402c0c-fd03-442d-95dc-e7d095566e32', 'ceebd4e7-d0da-4d33-9f50-b8fea0a69dc5', 'qweqwe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-17 00:02:56', '2023-11-17 00:02:56'),
('b182a916-5b20-4691-af81-c3d63d7ddee0', '4bac675c-f369-4680-b541-1fbc5f468f38', 'KABID Pengendalian Pencemaran dan Kerusakan LH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-20 21:01:20', '2023-11-20 21:01:20'),
('b1f6483a-c115-4192-bad8-19de721ca055', '96e1cc1e-43e3-42f4-9814-d1ac1f803671', 'Testing', '16210019', 'Tes', 'Ting', 'Kota', '1998-12-30', 'L', 'A', 'KTP', '123', '123', 'Alamat Testing', 'Kelurahan Testing', 'Kecamatan Testing', 'Kota Testing', '123', '123', 'Kristen', 'Singel', '-', '-', '-', '2010-01-01', '2023-01-01', 'Tes', 10, '2024-01-31 04:43:03', '2024-01-31 05:01:40'),
('b5049604-a709-4639-81f0-50edebf007b9', '3fa86f09-4a80-462b-8e90-edd5b02fd420', 'Pengendali Dampak Lingkungan Muda', '-', '-', 'S.Sos', 'Tataaran', '1967-08-01', 'P', 'B', 'KTP', '-', '-', '-', '-', '-', '-', '-', '-', 'Kristen', 'Menikah', '-', '-', '-', '1991-01-01', '2013-10-01', 'III/d', 90, '2023-11-20 22:28:30', '2024-01-31 00:58:59'),
('c4b7838d-d2e8-47f5-9dc9-8735db1e5f7f', '910f1886-fd61-4118-8775-1bcf9dc959a3', 'Pengelola Barang Milik Negara', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-20 21:05:52', '2023-11-20 21:05:52'),
('d891407e-f8d7-4f92-88cd-8c3793e8d29c', '479b6a35-e7e1-4cdb-9cad-5f4f6f97d43b', 'Pengendali Dampak Lingkungan Muda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-20 22:03:32', '2023-11-20 22:03:32'),
('d9046cef-c733-48b8-af55-34c9d3c583eb', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', 'Manusia', '123', 'tes', 'tes', 'tes', '2023-11-19', 'L', 'B', 'KTP', '123', '123', 'tes', 'tes', 'tes', 'tes', '123', '123', 'Kristen', 'Singel', '123', '123', 'tes', '2023-11-19', '2020-11-14', 'tes', 30, '2023-11-17 18:23:08', '2023-11-18 22:59:28'),
('e2289e67-72ec-406b-9dc7-2dc12061c61f', 'cfd932be-00d3-42c6-a471-ce70d22e6536', 'Kasubang Umum, Kepegawayan dan Perlengkapan', '-', 'Dra', '-', 'Tondano', '1966-10-01', 'P', 'O', 'KTP', '-', '-', '-', '-', '-', '-', '-', '-', 'Kristen', 'Menikah', '-', '-', '-', '1998-02-01', '2009-04-01', 'III/d', 90, '2023-11-20 22:37:25', '2024-01-31 00:55:23'),
('e35524db-44c6-4686-b5c0-2319fd9116b7', '9f31e71c-a225-44ca-aa3d-eabdc19145dd', 'Kabid Pengelolaan Sampah, LB-3 dan Peningkatan Kapasitas', '560 015 723', '-', 'SP', 'Tomohon', '1975-09-12', 'P', 'O', 'KTP', '7102185209750001', '49.926.135.2-821.000', 'Lingkungan III', 'Kelurahan Tataaran II', 'Tondano Selatan', 'Minahasa', '95616', '081340806997', 'Katholik', 'Menikah', '164', '78', 'Membaca', '2000-03-01', '2023-10-01', 'III/d', 90, '2023-11-20 22:41:42', '2023-11-21 02:29:35'),
('e3742a1d-8fef-4712-94a7-0bcef02b8841', '2d024d1b-14aa-4ecf-9a8b-7b0a26509806', 'Kepala Dinas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-20 20:56:46', '2023-11-20 20:56:46'),
('efcf9aa5-f736-4252-8ed1-b13b2d06503a', '14e6ef60-b9a5-408c-b40e-78297730dd6d', 'Sekretaris', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-20 20:59:06', '2023-11-20 20:59:06'),
('f41c4d84-166d-47f8-b378-3b64c391a7f2', '45f4b159-97b4-43ee-864e-788cc8269348', 'Pengendali Dampak Lingkungan Muda', '-', '-', 'SE', 'Minahasa', '1972-03-22', 'L', 'O', 'KTP', '-', '-', 'Amongena', 'Desa Amongena', 'Langowan Timur', 'Minahasa', '9569', '-', 'Kristen', 'Menikah', '-', '-', '-', '2007-01-01', '2023-10-01', 'III/c', 94, '2023-11-20 22:13:08', '2023-11-21 03:08:51'),
('f59ffc02-43fe-48f3-8194-c1db724ada45', '640e229d-06f3-48af-a56f-d385e0269f76', 'Pengadministrasi Umum', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-20 21:58:08', '2023-11-20 21:58:08'),
('ff0508a8-2fea-4b60-98e4-e97fb742b408', '345df725-9c1c-4690-a39b-23b1e8ed78d4', 'Pengadministrasi Umum', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-20 22:01:12', '2023-11-20 22:01:12');

-- --------------------------------------------------------

--
-- Table structure for table `pemberitahuan`
--

CREATE TABLE `pemberitahuan` (
  `id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `dibaca` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('terdaftar_periode','rekomendasi_naik_pangkat','batal_rekomendasi_naik_pangkat','perbaikan_berkas','berkas_diterima','sk_kp_dikirim','semua_sk_kp_dikirim') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemberitahuan`
--

INSERT INTO `pemberitahuan` (`id`, `user_id`, `keterangan`, `dibaca`, `status`, `created_at`, `updated_at`) VALUES
('02a17c06-f83e-405a-b1f2-1d9b15c2cc9d', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda belum direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>1 Oktober</strong>, karena salah satu atau kedua standar penilaian belum terpenuhi:</p>\n                    <p></p>            \n            <p>Kinerja Pegawai : Kurang (50-59)</p><p>Lamanya Masa Kerja : Cukup Lama (2-3 tahun)</p><hr> <i>Standad Penilaian : Lamanya Masa Kerja minimal lebih dari 3 tahun & Kinerja Pegawai minimal 70.</i>', 0, 'batal_rekomendasi_naik_pangkat', '2023-11-17 20:46:20', '2023-11-17 20:46:20'),
('02c62950-8ce1-4155-8748-a07aa2834146', '9f31e71c-a225-44ca-aa3d-eabdc19145dd', '<p>Anda belum direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>1 Oktober 2023</strong>, karena salah satu atau kedua standar penilaian belum terpenuhi:</p>\n                    <p></p>            \n            <p>Kinerja Pegawai : Baik (90-100)</p><p>Lamanya Masa Kerja : Baru (≤1 tahun)</p><hr> <i>Standad Penilaian : Lamanya Masa Kerja minimal lebih dari 3 tahun & Kinerja Pegawai minimal 70.</i>', 1, 'batal_rekomendasi_naik_pangkat', '2023-11-22 21:05:43', '2023-11-22 21:06:07'),
('054ea39a-7d72-4213-a946-56399e06dcd2', 'cc08f2cf-da4c-4e32-9139-2d33f0025720', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-17 06:30:20', '2023-11-17 06:30:20'),
('09634f3a-b938-4413-983e-a7e7a9762b71', 'cc08f2cf-da4c-4e32-9139-2d33f0025720', '<p>Anda direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>1 Oktober</strong>.</p><p>Selanjutnya silahkan mengirim berkas untuk pengajuan sesuai dengan ketentuan.</p>', 0, 'rekomendasi_naik_pangkat', '2023-11-20 02:51:05', '2023-11-20 02:51:05'),
('0cdef543-c542-41ec-8e74-bded90d6a645', 'cc08f2cf-da4c-4e32-9139-2d33f0025720', '<p>Anda terdaftar pada periode <strong>1 Oktober 2023</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-08 22:16:01', '2023-11-08 22:16:01'),
('11a65c12-bec5-41d6-8bd1-d93fd9970820', 'ce84d87b-666d-4594-b5cc-e8a113f0ba0d', '<p>Anda belum direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>APRIL 2024</strong>, karena salah satu atau kedua standar penilaian belum terpenuhi:</p>\n                    <p></p>            \n            <p>Lamanya Masa Kerja : Lama(1-2 Tahun)</p><p>Kinerja Pegawai : Cukup (70-89)</p><hr> <i>Standad Penilaian : Lamanya Masa Kerja minimal lebih dari 3 tahun & Kinerja Pegawai minimal 70.</i>', 0, 'batal_rekomendasi_naik_pangkat', '2024-01-31 01:18:53', '2024-01-31 01:18:53'),
('16203d9e-d881-44d2-92af-96b959ac1975', 'cc08f2cf-da4c-4e32-9139-2d33f0025720', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-19 02:42:53', '2023-11-19 02:42:53'),
('18e3e6f2-6e8e-4480-839b-43032f9ce8a6', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda belum direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>1 Oktober</strong>, karena salah satu atau kedua standar penilaian belum terpenuhi:</p>\n                    <p></p>            \n            <p>Kinerja Pegawai : Baik (90-100)</p><p>Lamanya Masa Kerja : Cukup Lama (2-3 tahun)</p><hr> <i>Standad Penilaian : Lamanya Masa Kerja minimal lebih dari 3 tahun & Kinerja Pegawai minimal 70.</i>', 0, 'batal_rekomendasi_naik_pangkat', '2023-11-17 19:57:13', '2023-11-17 19:57:13'),
('18e52ae6-e0f3-4617-b126-0f1fd013bd77', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-17 19:23:53', '2023-11-17 19:23:53'),
('19e9ee82-40a7-446f-a5f3-7446cc13776e', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-17 19:26:20', '2023-11-17 19:26:20'),
('223f1e22-08b7-42d5-b5f8-44beb585b4e3', 'cc08f2cf-da4c-4e32-9139-2d33f0025720', '<p>Anda belum direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>1 Oktober</strong>, karena salah satu atau kedua standar penilaian belum terpenuhi:</p>\n                    <p></p>            \n            <p>Kinerja Pegawai : Baik (90-100)</p><p>Lamanya Masa Kerja : Cukup Lama (2-3 tahun)</p><hr> <i>Standad Penilaian : Lamanya Masa Kerja minimal lebih dari 3 tahun & Kinerja Pegawai minimal 70.</i>', 0, 'batal_rekomendasi_naik_pangkat', '2023-11-19 02:40:24', '2023-11-19 02:40:24'),
('26ba6885-007c-4f72-b04e-f87c93014e0d', '5c10d177-a69d-4f48-9bf1-72e1d7d76686', '<p>Anda terdaftar pada periode <strong>1 Oktober 2023</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-22 21:01:55', '2023-11-22 21:01:55'),
('2ab23c6d-7b34-49de-ae69-d8ac8714c617', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-17 20:03:23', '2023-11-17 20:03:23'),
('36f7eb44-0c4a-499e-820d-44406a7bba1b', 'f3e696bc-0076-4ae8-b210-64fc2aad9c1b', '<p>Anda direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>APRIL 2024</strong>.</p><p>Selanjutnya silahkan mengirim berkas untuk pengajuan sesuai dengan ketentuan.</p>', 0, 'rekomendasi_naik_pangkat', '2024-01-31 01:18:33', '2024-01-31 01:18:33'),
('3c78b824-c50b-4e62-8087-4d7a98ef5d92', 'cc08f2cf-da4c-4e32-9139-2d33f0025720', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-14 23:19:41', '2023-11-14 23:19:41'),
('3c9b80f9-9d4f-4feb-8d65-8e3613a080d7', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-17 18:31:45', '2023-11-17 18:31:45'),
('3e79438f-054a-4b8d-a0a9-904bda799210', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-17 20:46:16', '2023-11-17 20:46:16'),
('3f2c0aad-aced-42c6-a5ad-508a1522236e', '5c10d177-a69d-4f48-9bf1-72e1d7d76686', '<p>Anda direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>1 Oktober</strong>.</p><p>Selanjutnya silahkan mengirim berkas untuk pengajuan sesuai dengan ketentuan.</p>', 0, 'rekomendasi_naik_pangkat', '2023-11-22 01:08:50', '2023-11-22 01:08:50'),
('44323fd2-2ad6-4b50-99e3-4fff98440145', '819b13d8-a9d2-49f7-aef3-ab75528931b6', '<p>Anda direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>1 Oktober</strong>.</p><p>Selanjutnya silahkan mengirim berkas untuk pengajuan sesuai dengan ketentuan.</p>', 0, 'rekomendasi_naik_pangkat', '2023-11-19 02:37:01', '2023-11-19 02:37:01'),
('456d1813-8f1a-4f1c-9af2-c85949f66445', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-17 19:57:10', '2023-11-17 19:57:10'),
('490f130f-ccbf-415e-8c48-1d517d229059', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-17 18:24:15', '2023-11-17 18:24:15'),
('4990233d-6b47-40ba-a2b8-9d4b463eb0cd', '5c10d177-a69d-4f48-9bf1-72e1d7d76686', '<p>Anda direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>1 Oktober 2023</strong>.</p><p>Selanjutnya silahkan mengirim berkas untuk pengajuan sesuai dengan ketentuan.</p>', 0, 'rekomendasi_naik_pangkat', '2023-11-22 21:02:04', '2023-11-22 21:02:04'),
('50050eec-531c-4eb6-baaa-d018d29edec8', 'ce84d87b-666d-4594-b5cc-e8a113f0ba0d', '<p>Anda terdaftar pada periode <strong>1 Oktober 2023</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2024-01-22 21:02:52', '2024-01-22 21:02:52'),
('55af88f9-c82b-4995-9a6e-dca8ef6cdb35', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-18 22:17:57', '2023-11-18 22:17:57'),
('57f4561b-b64f-4e94-92d2-432fe8de8057', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>1 Oktober</strong>.</p><p>Selanjutnya silahkan mengirim berkas untuk pengajuan sesuai dengan ketentuan.</p>', 0, 'rekomendasi_naik_pangkat', '2023-11-17 19:26:25', '2023-11-17 19:26:25'),
('59ffb9f2-3661-44dd-ad0a-bf04dddb4f95', 'cc08f2cf-da4c-4e32-9139-2d33f0025720', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-19 19:30:39', '2023-11-19 19:30:39'),
('5f6aab38-ac86-4310-98dd-cc35aac64ca3', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-17 19:47:10', '2023-11-17 19:47:10'),
('61d88e74-54bb-4a6d-8bb0-1a9af60d85fc', 'cc08f2cf-da4c-4e32-9139-2d33f0025720', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-20 02:45:32', '2023-11-20 02:45:32'),
('6238a369-b948-4ca2-ab2b-5f23732eedf4', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-17 18:23:32', '2023-11-17 18:23:32'),
('6262245b-8d0a-4021-b879-1e7582967eb6', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-17 19:32:18', '2023-11-17 19:32:18'),
('67c32bb7-c906-4c25-b9ce-a805a831e593', 'cc08f2cf-da4c-4e32-9139-2d33f0025720', '<p>Berkas yang dikirim untuk pengajuan kenaikan pangkat pada periode <strong>1 Oktober 2023</strong> harus diperbaiki.</p><br><p><strong>Keterangan:</strong></p><p>SKP', 0, 'perbaikan_berkas', '2023-11-08 23:21:52', '2023-11-08 23:21:52'),
('6b272b9b-4497-43cf-a2cf-ff4306b19492', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-17 18:33:49', '2023-11-17 18:33:49'),
('6bbd0b95-9676-403d-952b-1363ef3e1924', 'cc08f2cf-da4c-4e32-9139-2d33f0025720', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-20 02:51:00', '2023-11-20 02:51:00'),
('77b2566e-2038-4e99-b2bf-fb5b04d050db', 'cc08f2cf-da4c-4e32-9139-2d33f0025720', '<p>Anda direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>1 Oktober</strong>.</p><p>Selanjutnya silahkan mengirim berkas untuk pengajuan sesuai dengan ketentuan.</p>', 0, 'rekomendasi_naik_pangkat', '2023-11-20 02:45:42', '2023-11-20 02:45:42'),
('78d60125-4c38-4779-8a37-6e39dc563844', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>1 Oktober</strong>.</p><p>Selanjutnya silahkan mengirim berkas untuk pengajuan sesuai dengan ketentuan.</p>', 0, 'rekomendasi_naik_pangkat', '2023-11-17 20:01:09', '2023-11-17 20:01:09'),
('7cf5dc2f-48d6-402a-a67f-daca163b3902', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-17 20:01:05', '2023-11-17 20:01:05'),
('7e3cb6c0-cd61-4a24-a918-960f37e40b74', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-17 18:38:44', '2023-11-17 18:38:44'),
('84521c27-b583-4817-9c9f-38c873f5dcf1', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-18 22:31:02', '2023-11-18 22:31:02'),
('85b511a1-c15e-40ad-9f9a-791460a53eaa', '5c10d177-a69d-4f48-9bf1-72e1d7d76686', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-22 01:08:40', '2023-11-22 01:08:40'),
('87d59bb8-38b1-452d-899e-8ff15914a476', 'cc08f2cf-da4c-4e32-9139-2d33f0025720', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-17 06:19:15', '2023-11-17 06:19:15'),
('8acf9c45-3ba8-4bb5-831c-b12b7891a11c', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda belum direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>1 Oktober</strong>, karena salah satu atau kedua standard penilaian belum terpenuhi:</p>\n                    <p></p>            \n            <p>Lamanya Masa Kerja : Lama(1-2 Tahun)</p><p>Kinerja Pegawai : Cukup (70-89)</p><hr> <i>Standad Penilaian : Lamanya Masa Kerja minimal lebih dari 3 tahun & Kinerja Pegawai minimal 70.</i>', 0, 'batal_rekomendasi_naik_pangkat', '2023-11-17 19:47:14', '2023-11-17 19:47:14'),
('8b7cdaaf-400d-4a46-be49-9b0b46e1f13a', '9f31e71c-a225-44ca-aa3d-eabdc19145dd', '<p>Anda terdaftar pada periode <strong>1 Oktober 2023</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 1, 'terdaftar_periode', '2023-11-22 21:05:39', '2023-11-22 21:06:15'),
('930b3cdb-f50e-438b-9f93-f43b8c3b782e', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda belum direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>1 Oktober</strong>, karena salah satu atau kedua standard penilaian belum terpenuhi:</p>\n                    <p></p>            \n            <p>Lamanya Masa Kerja : Cukup Lama (2-3 tahun)</p><p>Kinerja Pegawai : Kurang (50-59)</p><hr> <i><stron>Standad Penilaian : Lamanya Masa Kerja minimal lebih dari 3 tahun & Kinerja Pegawai minimal 70.</strong></i>', 0, 'batal_rekomendasi_naik_pangkat', '2023-11-17 19:43:33', '2023-11-17 19:43:33'),
('9712f08b-85b2-4de4-9838-4a44419932dc', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda belum direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>1 Oktober</strong>, karena salah satu atau kedua standar penilaian belum terpenuhi:</p>\n                    <p></p>            \n            <p>Lamanya Masa Kerja : Baru (≤1 tahun)</p><p>Kinerja Pegawai : Sangat Kurang (<50)</p><hr> <i>Standad Penilaian : Lamanya Masa Kerja minimal lebih dari 3 tahun & Kinerja Pegawai minimal 70.</i>', 0, 'batal_rekomendasi_naik_pangkat', '2023-11-18 22:31:05', '2023-11-18 22:31:05'),
('9fec8b12-eee5-4d21-b042-99d1c9224923', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-17 19:43:29', '2023-11-17 19:43:29'),
('a37006f3-93c3-4fa8-abda-595a1cc86c4c', 'cc08f2cf-da4c-4e32-9139-2d33f0025720', '<p>Anda direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>1 Oktober</strong>.</p><p>Selanjutnya silahkan mengirim berkas untuk pengajuan sesuai dengan ketentuan.</p>', 0, 'rekomendasi_naik_pangkat', '2023-11-19 02:42:57', '2023-11-19 02:42:57'),
('a613316a-6dc4-4ffd-ac52-ce2185ae2bea', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-18 22:29:00', '2023-11-18 22:29:00'),
('a6c77946-bde6-4c35-90ea-4dcb5173e2a5', 'e1b934c7-3215-48a4-956f-f74ac7bca072', '<p>Anda direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>APRIL 2024</strong>.</p><p>Selanjutnya silahkan mengirim berkas untuk pengajuan sesuai dengan ketentuan.</p>', 0, 'rekomendasi_naik_pangkat', '2024-01-31 04:31:20', '2024-01-31 04:31:20'),
('a8bd2bbd-ad25-4200-954c-682e431b4a58', 'f3e696bc-0076-4ae8-b210-64fc2aad9c1b', '<p>Anda terdaftar pada periode <strong>APRIL 2024</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2024-01-31 01:18:31', '2024-01-31 01:18:31'),
('aac15bbf-b2a8-47e8-aa5c-db70b6d4ae0f', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-17 19:58:32', '2023-11-17 19:58:32'),
('ab38a5ed-1b00-45f7-a6c0-70a3f5e223f2', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda belum direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>1 Oktober</strong>, karena salah satu atau kedua standar penilaian belum terpenuhi:</p>\n                    <p></p>            \n            <p>Lamanya Masa Kerja : Sangat Lama (>3 Tahun)</p><p>Kinerja Pegawai : Kurang (50-59)</p><hr> <i>Standad Penilaian : Lamanya Masa Kerja minimal lebih dari 3 tahun & Kinerja Pegawai minimal 70.</i>', 0, 'batal_rekomendasi_naik_pangkat', '2023-11-17 20:03:27', '2023-11-17 20:03:27'),
('ad3e2125-de44-493d-abac-e1b58f7f35c1', 'ce84d87b-666d-4594-b5cc-e8a113f0ba0d', '<p>Anda terdaftar pada periode <strong>APRIL 2024</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2024-01-31 00:22:28', '2024-01-31 00:22:28'),
('b2d9bfa5-c04b-4199-bb91-e01ef8bfe504', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-17 18:43:38', '2023-11-17 18:43:38'),
('b443e1eb-830c-41da-a31c-406a93b25bbd', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda belum direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>1 Oktober</strong>, karena salah satu atau kedua standar penilaian belum terpenuhi:</p>\n                    <p></p>            \n            <p>Lamanya Masa Kerja : </p><p>Kinerja Pegawai : </p><hr> <i>Standad Penilaian : Lamanya Masa Kerja minimal lebih dari 3 tahun & Kinerja Pegawai minimal 70.</i>', 0, 'batal_rekomendasi_naik_pangkat', '2023-11-18 22:29:04', '2023-11-18 22:29:04'),
('b4e4e776-4dec-46ee-87ca-3ba431206697', 'ce84d87b-666d-4594-b5cc-e8a113f0ba0d', '<p>Anda terdaftar pada periode <strong>APRIL 2024</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2024-01-31 01:18:51', '2024-01-31 01:18:51'),
('bf0c4f80-4c09-4f0e-a165-a59be55a4173', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-17 18:27:16', '2023-11-17 18:27:16'),
('c270d483-5d16-4b22-8b5e-96aad3a69d54', 'ce84d87b-666d-4594-b5cc-e8a113f0ba0d', '<p>Anda direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>APRIL 2024</strong>.</p><p>Selanjutnya silahkan mengirim berkas untuk pengajuan sesuai dengan ketentuan.</p>', 0, 'rekomendasi_naik_pangkat', '2024-01-31 00:22:31', '2024-01-31 00:22:31'),
('c8ee2da8-3664-42d4-ab61-698ebdb17bbc', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda belum direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>1 Oktober</strong>, karena salah satu atau kedua standar penilaian belum terpenuhi:</p>\n                    <p></p>            \n            <p>Kinerja Pegawai : Sangat Kurang (<50)</p><p>Lamanya Masa Kerja : Sangat Lama (>3 Tahun)</p><hr> <i>Standad Penilaian : Lamanya Masa Kerja minimal lebih dari 3 tahun & Kinerja Pegawai minimal 70.</i>', 0, 'batal_rekomendasi_naik_pangkat', '2023-11-18 23:06:06', '2023-11-18 23:06:06'),
('c907fa54-0053-4210-bd82-ff106d1d37da', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-18 23:06:02', '2023-11-18 23:06:02'),
('caaef470-facf-46da-9023-f209f05b0825', 'cfd932be-00d3-42c6-a471-ce70d22e6536', '<p>Anda direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>APRIL 2024</strong>.</p><p>Selanjutnya silahkan mengirim berkas untuk pengajuan sesuai dengan ketentuan.</p>', 0, 'rekomendasi_naik_pangkat', '2024-01-31 01:19:07', '2024-01-31 01:19:07'),
('cad61f56-74b6-46f0-8876-63276ce45bc2', 'cc08f2cf-da4c-4e32-9139-2d33f0025720', '<p>Anda direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>1 Oktober</strong>.</p><p>Selanjutnya silahkan mengirim berkas untuk pengajuan sesuai dengan ketentuan.</p>', 0, 'rekomendasi_naik_pangkat', '2023-11-19 19:30:45', '2023-11-19 19:30:45'),
('d0f4add2-8d65-4f9d-8657-2e01ea82b2f4', 'ce84d87b-666d-4594-b5cc-e8a113f0ba0d', '<p>Anda direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>1 Oktober 2023</strong>.</p><p>Selanjutnya silahkan mengirim berkas untuk pengajuan sesuai dengan ketentuan.</p>', 0, 'rekomendasi_naik_pangkat', '2024-01-22 21:02:55', '2024-01-22 21:02:55'),
('d5454f89-b8df-4587-8726-59fbe4a1eb53', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-17 18:42:49', '2023-11-17 18:42:49'),
('d5af7b5d-d65e-412e-9794-ab0b95b0ec1e', 'cc08f2cf-da4c-4e32-9139-2d33f0025720', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-19 02:40:19', '2023-11-19 02:40:19'),
('d63f15d7-99b6-4bb8-937b-c01512cc8527', '819b13d8-a9d2-49f7-aef3-ab75528931b6', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-19 02:36:55', '2023-11-19 02:36:55'),
('db9f297e-6a0e-4294-973c-a5ef415c9daa', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda belum direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>1 Oktober</strong>, karena salah satu atau kedua standar penilaian belum terpenuhi:</p>\n                    <p></p>            \n            <p>Lamanya Masa Kerja : Baru (≤1 tahun)</p><p>Kinerja Pegawai : Sangat Kurang (<50)</p><hr> <i>Standad Penilaian : Lamanya Masa Kerja minimal lebih dari 3 tahun & Kinerja Pegawai minimal 70.</i>', 0, 'batal_rekomendasi_naik_pangkat', '2023-11-18 22:18:02', '2023-11-18 22:18:02'),
('ddcad62c-b088-4fd9-9c0a-7c025ce0bc62', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-17 18:24:57', '2023-11-17 18:24:57'),
('dfeaafe5-4867-48de-87b9-8b61f6be801c', 'cc08f2cf-da4c-4e32-9139-2d33f0025720', '<p>Anda direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>1 Oktober</strong>.</p><p>Selanjutnya silahkan mengirim berkas untuk pengajuan sesuai dengan ketentuan.</p>', 0, 'rekomendasi_naik_pangkat', '2023-11-14 23:46:19', '2023-11-14 23:46:19'),
('e3d1e3b5-7372-413a-af77-f1379795cf80', 'cfd932be-00d3-42c6-a471-ce70d22e6536', '<p>Anda terdaftar pada periode <strong>APRIL 2024</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2024-01-31 01:19:05', '2024-01-31 01:19:05'),
('ea28db8a-991d-4fd0-ab39-58c62cae362f', 'cc08f2cf-da4c-4e32-9139-2d33f0025720', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-17 06:30:16', '2023-11-17 06:30:16'),
('ecac29a0-8501-4d42-84c4-23cd80675bf8', 'cc08f2cf-da4c-4e32-9139-2d33f0025720', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-17 06:30:24', '2023-11-17 06:30:24'),
('f0fa71da-6044-40b7-9f7e-d4573413d244', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda belum direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>1 Oktober</strong>, karena :</p>\n                    <p></p>            \n            <p>Kinerja Pegawai : Kurang (50-59)</p><p>Lamanya Masa Kerja : Sangat Lama (>3 Tahun)</p>', 1, 'batal_rekomendasi_naik_pangkat', '2023-11-17 19:32:22', '2023-11-17 19:35:17'),
('f379eb90-7ed4-496b-b2b0-7fcf608fe1e3', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda belum direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>1 Oktober</strong>, karena :</p>\n                    <p></p>            \n            ', 0, 'batal_rekomendasi_naik_pangkat', '2023-11-17 19:23:57', '2023-11-17 19:23:57'),
('f7c8161e-0ee1-434f-b677-133ed5c3e214', 'cc08f2cf-da4c-4e32-9139-2d33f0025720', '<p>Anda direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>1 Oktober 2023</strong>.</p><p>Selanjutnya silahkan mengirim berkas untuk pengajuan sesuai dengan ketentuan.</p>', 0, 'rekomendasi_naik_pangkat', '2023-11-08 22:16:26', '2023-11-08 22:16:26'),
('fb1de639-595d-4a56-9f84-9c7cb3b69e95', 'ceebd4e7-d0da-4d33-9f50-b8fea0a69dc5', '<p>Anda terdaftar pada periode <strong>1 Oktober</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2023-11-17 00:04:08', '2023-11-17 00:04:08'),
('fce55633-8a24-430d-a30f-3d0a03082b85', 'e1b934c7-3215-48a4-956f-f74ac7bca072', '<p>Anda terdaftar pada periode <strong>APRIL 2024</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>', 0, 'terdaftar_periode', '2024-01-31 04:31:17', '2024-01-31 04:31:17'),
('fd959fdc-066e-4366-a374-ec610780a822', 'a9c6c9c7-1887-4b82-81ad-790b70cb9c01', '<p>Anda direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>1 Oktober</strong>.</p><p>Selanjutnya silahkan mengirim berkas untuk pengajuan sesuai dengan ketentuan.</p>', 0, 'rekomendasi_naik_pangkat', '2023-11-17 19:58:36', '2023-11-17 19:58:36');

-- --------------------------------------------------------

--
-- Table structure for table `peninjauan_berkas`
--

CREATE TABLE `peninjauan_berkas` (
  `id` char(36) NOT NULL,
  `periode_id` char(36) NOT NULL,
  `alternatif_id` char(36) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `status` enum('perbaikan','diterima') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peninjauan_berkas`
--

INSERT INTO `peninjauan_berkas` (`id`, `periode_id`, `alternatif_id`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
('0125975b-0827-4c9f-b445-4556fbe766cc', 'a9a935be-9d93-4bff-af31-70c7fcaf18dd', '42340056-27f0-4991-a9ad-51459bd540ba', 'SKP', 'perbaikan', '2023-11-08 23:21:52', '2023-11-08 23:21:52');

-- --------------------------------------------------------

--
-- Table structure for table `perankingan`
--

CREATE TABLE `perankingan` (
  `id` char(36) NOT NULL,
  `periode_id` char(36) NOT NULL,
  `alternatif_id` char(36) NOT NULL,
  `nilai` double NOT NULL DEFAULT 0,
  `direkomendasi` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perankingan`
--

INSERT INTO `perankingan` (`id`, `periode_id`, `alternatif_id`, `nilai`, `direkomendasi`, `created_at`, `updated_at`) VALUES
('379dce50-71e6-4d7c-b022-bde0301d2641', '55a94d1b-2aa3-4815-9d3d-665ca124dc85', '326f07c0-7a95-4ddc-9ab7-626867ba3471', 0.48425563407181, 1, '2024-01-22 21:02:52', '2024-01-22 21:02:55'),
('4897e51d-5b4a-411c-8401-b5702841507a', 'a9a935be-9d93-4bff-af31-70c7fcaf18dd', '42340056-27f0-4991-a9ad-51459bd540ba', 0.48425563407181, 1, '2023-11-08 22:16:01', '2023-11-08 22:16:26'),
('5be741dc-e59f-4c0b-8920-35bdac5ca1a1', '3683cc3e-1c74-4b39-b1f2-ae8700862365', '7adf3fd7-5534-483a-9f6a-6fe7bfba5d68', 0.55789247517189, 1, '2023-11-22 01:08:40', '2023-11-22 01:08:50'),
('67ff7d18-4288-464b-aab1-13112d999780', '5dd35696-794b-4198-af3a-64eb2b8bdccb', '0ad4ccc1-96ee-45e4-a1ea-86a1eb652b93', 0.55789247517189, 1, '2024-01-31 01:19:05', '2024-01-31 01:19:07'),
('8750226a-fd82-4bf6-819a-f24b100bfb9d', '5dd35696-794b-4198-af3a-64eb2b8bdccb', '23487b73-6296-4f26-b54f-9e62b8d890b4', 0.48425563407181, 1, '2024-01-31 01:18:31', '2024-01-31 01:18:33'),
('ae97e74e-927d-4a3c-941c-a30a41901165', '5dd35696-794b-4198-af3a-64eb2b8bdccb', 'eb7c087f-769b-4a44-a46a-9afaaf527972', 0.48425563407181, 1, '2024-01-31 04:31:17', '2024-01-31 04:31:20'),
('c274e859-ef96-4fde-bd33-cbd030be80b5', 'cd980d13-c884-4bb2-9293-5d583a032db0', '8de9f5e7-ebd8-4b3c-9772-9b7cc46a51ae', 0.48425563407181, 1, '2024-01-31 00:22:28', '2024-01-31 00:22:31'),
('f069ca4b-7b43-4a8a-9112-be72f819f85a', '5dd35696-794b-4198-af3a-64eb2b8bdccb', '6f0d0544-0555-4986-b904-172d1c2c921b', 0.15724073720398, 0, '2024-01-31 01:18:51', '2024-01-31 01:18:53');

-- --------------------------------------------------------

--
-- Table structure for table `periode_naik_pangkat`
--

CREATE TABLE `periode_naik_pangkat` (
  `id` char(36) NOT NULL,
  `kode` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `status` enum('sementara','selesai') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `periode_naik_pangkat`
--

INSERT INTO `periode_naik_pangkat` (`id`, `kode`, `nama`, `status`, `created_at`, `updated_at`) VALUES
('5dd35696-794b-4198-af3a-64eb2b8bdccb', 1, 'APRIL 2024', 'sementara', '2024-01-31 01:15:41', '2024-01-31 01:15:41');

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
-- Table structure for table `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id` char(36) NOT NULL,
  `kriteria_id` char(36) NOT NULL,
  `kode` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jumlah_bobot` double NOT NULL DEFAULT 0,
  `jumlah_eigen` double NOT NULL DEFAULT 0,
  `rata_eigen` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id`, `kriteria_id`, `kode`, `nama`, `jumlah_bobot`, `jumlah_eigen`, `rata_eigen`, `created_at`, `updated_at`) VALUES
('37a2340e-e13e-4682-956e-cbed14cfdb1a', 'e830576e-591e-4d01-8ebf-0ce28185e501', 5, 'Baik (90-100)', 1.6761904761905, 2.2315699006876, 0.55789247517189, '2023-11-08 21:57:25', '2023-11-08 22:09:20'),
('672abd5d-14dd-4738-82f6-d4db81defaa6', '7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f', 4, 'Baru (≤1 tahun)', 16, 0.22755920550038, 0.056889801375095, '2023-11-08 21:55:44', '2023-11-08 22:04:27'),
('8680423c-d029-4645-b532-9d809af606e3', '7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f', 1, 'Sangat Lama (>3 Tahun)', 1.6761904761905, 2.2315699006875, 0.55789247517189, '2023-11-08 21:54:40', '2023-11-08 22:04:27'),
('99fe40d8-c78d-494c-9118-029c9610888a', 'e830576e-591e-4d01-8ebf-0ce28185e501', 7, 'Kurang (50-69)', 9.3333333333333, 0.48749045072574, 0.12187261268144, '2023-11-08 21:58:49', '2023-11-08 22:09:20'),
('a3e44379-2200-48fc-8abe-de688291fa62', 'e830576e-591e-4d01-8ebf-0ce28185e501', 6, 'Cukup (70-89)', 4.5333333333333, 1.0533804430863, 0.26334511077158, '2023-11-08 21:58:15', '2023-11-08 22:09:20'),
('b3fb1ffb-f0c4-497c-a808-1d12837f9246', '7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f', 3, 'Lama(1-2 Tahun)', 9.3333333333333, 0.48749045072574, 0.12187261268144, '2023-11-08 21:55:26', '2023-11-08 22:04:27'),
('d024f740-7af0-44f3-8e7c-5ec53c3a0b1f', 'e830576e-591e-4d01-8ebf-0ce28185e501', 8, 'Sangat Kurang (<50)', 16, 0.22755920550038, 0.056889801375095, '2023-11-08 21:59:25', '2023-11-08 22:09:20'),
('e17f32ba-4981-4801-9cfa-aea4cc6dfd19', '7aa84f09-ada0-4e1d-aeac-8d5eaec82d1f', 2, 'Cukup Lama (2-3 tahun)', 4.5333333333333, 1.0533804430863, 0.26334511077158, '2023-11-08 21:55:07', '2023-11-08 22:04:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','pegawai','bkpsdm') DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `nip`, `email_verified_at`, `password`, `role`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
('15b2709c-8438-4352-b88b-836d76914411', 'Hesky L. Tiwa, S.Sos', 'heskytiwa@gmail.com', '19751021 200701 1 006', NULL, '$2y$10$UIjo6/ao9nCmvxIxW.3D3O.81vfpPhiSnWg8izG/um1Z6JPbyjz6G', 'pegawai', NULL, NULL, '2023-11-20 22:15:18', '2023-11-20 22:15:18'),
('2fd77034-9941-4b44-8ff8-3181a57476fa', 'Nories G. Sigar', 'noriessigar@gmail.com', '19771106  200604 1 005', NULL, '$2y$10$L0H/UCY0yFpkYaj/CvdFFuoWtZRfUDP33WDyxreCYbhc2Kx9eExXS', 'pegawai', NULL, NULL, '2023-11-20 21:46:13', '2023-11-21 02:25:03'),
('345df725-9c1c-4690-a39b-23b1e8ed78d4', 'Franky A. Tembesi', 'frankytambesi@gmail.com', '19691125 199203 1 007', NULL, '$2y$10$0uRjtS2Hi5kvbJFRe9OlzuiLVn5WRGHG0WbyYDOL9.hlf9uEbmyUW', 'pegawai', NULL, NULL, '2023-11-20 22:01:12', '2023-11-20 22:01:12'),
('3f567902-40b5-429f-87b9-27ab0ab3bf6c', 'Feibie F.V Karisoh', 'feibiekarisoh@gmail.com', '19720205 199603 2 003', NULL, '$2y$10$Hr4KwS/AQByOOJ5kA9YjfO2PmanxeYH.UT4SW6Fk9waBxI3IQhA3.', 'pegawai', NULL, NULL, '2023-11-20 22:50:09', '2024-01-31 00:54:31'),
('3fa86f09-4a80-462b-8e90-edd5b02fd420', 'Mediatrix Rouna Moningka', 'rounamoningka@gmail.com', '19670801 199101 2 001', NULL, '$2y$10$EMd2Re.0aQ6ZnPaJAZgUheD3aklmjASIC.ox7MziG00RHrLJ7vtTi', 'pegawai', NULL, NULL, '2023-11-20 22:28:30', '2024-01-31 00:58:59'),
('434f5c67-d763-4568-84d9-94bdb70785b1', 'Jeremiah V.S.C Sondakh, SKM', 'jeremiahsondakh@gmail.com', '19830514 200604 1 014', NULL, '$2y$10$RW8dHmb7aBpeMx7GkgVHQO1Pl9sFiZQbMB5e/G6RhvNfcm3I84V..', 'pegawai', NULL, NULL, '2023-11-20 22:21:48', '2023-11-20 22:21:48'),
('45f4b159-97b4-43ee-864e-788cc8269348', 'Moudy H. Manopo', 'moudymanopo@gmail.com', '19720322 200701 1 008', NULL, '$2y$10$.gl05WqMdeSz4boWT/I7XunRla1S/TklPDK8mfoIYAuUU.eWpdWEG', 'pegawai', NULL, NULL, '2023-11-20 22:13:08', '2023-11-21 03:08:51'),
('479b6a35-e7e1-4cdb-9cad-5f4f6f97d43b', 'Nona Matindas', 'nonamatindas@gmail.com', '19660818 199403 2 004', NULL, '$2y$10$YOWguFC9h7YSQbz8J.lIsOEKgZE0fdPMxjws8cMudDDP101q3ovpu', 'pegawai', NULL, NULL, '2023-11-20 22:03:32', '2023-11-20 22:03:32'),
('64e50665-9913-46ed-99ed-9dc95f15f8bb', 'Novly N. Lumingkewas', 'novlylumingkewas@gmail.com', '19681102 199603 2 005', NULL, '$2y$10$gs6u3Sms9tHGKUR6k6XKj.Gg66MRtRvfXezP22Ki/U3d6lLlW29Dm', 'pegawai', NULL, NULL, '2023-11-20 22:46:18', '2024-01-31 00:54:57'),
('6b463ad6-cf74-4278-9657-35bfbe556b95', 'BKPSDM Minahasa12', 'bkpsdmminahasa73@gmail.com', NULL, NULL, '$2y$10$MFSguxi14SlIDM2iBgWfJumldfytSLKBlA8K6CeZOnbm.z1TmsJpa', 'bkpsdm', NULL, NULL, '2023-09-30 06:37:48', '2023-11-22 21:07:38'),
('7238210b-cd11-4d7e-9b70-765d83a78cc2', 'Ingrid Posumah', 'ingridposumah@gmail.com', '19810123 200212 2 004', NULL, '$2y$10$dhuHEdLII4EzjdxSntdWvexq7ZIM/2uUe1dQAYvtXgzAPpzdckbBG', 'pegawai', NULL, NULL, '2023-11-20 22:32:07', '2024-01-31 00:55:51'),
('89d4e096-9576-4417-a72f-85943301378f', 'Admin', 'dlhminahasa896@gmail.com', NULL, NULL, '$2y$10$.fVyY7byn4hJZu7Zr6DsT.1k6eIUKUeaAf0wFQJtEg/fU1T4DPbXi', 'admin', NULL, NULL, '2023-09-30 06:38:23', '2023-09-30 21:36:31'),
('96e1cc1e-43e3-42f4-9814-d1ac1f803671', 'Refandi Andika Runtu', 'runtufandi@gmail.com', '16210019', NULL, '$2y$10$xVNRu3dhO2MeWo4g1URfSedWoXLTmUPcMtX.W9z7iHv/Y3qPX3fnG', 'pegawai', NULL, NULL, '2024-01-31 04:43:03', '2024-01-31 05:01:40'),
('ca4993b8-7d27-4c61-9da2-517372376dc6', 'Lelfi Mailensun', 'lelfimailensun@gmail.com', '19730402 200212 2 009', NULL, '$2y$10$Fqhw9RzMDiHE2A2nOyZ8autXJetJpS5OJTIllP5CDa9abKMHgy3I.', 'pegawai', NULL, NULL, '2023-11-20 21:40:44', '2023-11-21 02:16:57'),
('ce84d87b-666d-4594-b5cc-e8a113f0ba0d', 'Maria', 'reginatambuwun123@gmail.com', '19210120', NULL, '$2y$10$CTi1HTlEGLR3fdDaeOyEq.XcfE.xpWD4rfQ70EIhKZTs8MWRZoN6G', 'pegawai', NULL, NULL, '2024-01-22 20:59:50', '2024-01-31 01:15:10'),
('cfd932be-00d3-42c6-a471-ce70d22e6536', 'Shady D. Pangerapan', 'shadypangerapan@gmail.com', '19661001 1998 02 2 003', NULL, '$2y$10$GB56aosNma7SL5yJBegWmOZr2LsPFIuMdvr.yiTjpUUrcjvVnNWB2', 'pegawai', NULL, NULL, '2023-11-20 22:37:25', '2024-01-31 00:55:23'),
('e1b934c7-3215-48a4-956f-f74ac7bca072', 'Akeman P. Sigar', 'akemansigar@gmail.com', '19660109 199401 1 001', NULL, '$2y$10$L083GyMcH2oLtrHTjsoFNelXrrOMow3vqEQvZRr6fQl8Ip44M83vy', 'pegawai', NULL, NULL, '2023-11-20 22:26:01', '2024-01-31 01:02:13'),
('e6c3c8c4-9bb4-4170-b630-9aad878e2ae6', 'Handri D. Tangkuman', 'handritangkuman@gmail.com', '19741231 199703 1 009', NULL, '$2y$10$gHJFDB/g5LtcFEER50vPFutA/S9oPqBUVMN2qe5xI4ZtrWIIOqaFq', 'pegawai', NULL, NULL, '2023-11-20 22:18:00', '2024-01-31 00:35:33'),
('f008b890-c2f7-42cf-abf8-6304c27791f7', 'Marvil G. Palandeng', 'marvilpalandeng@gmail.com', '19860319 201408 1 001', NULL, '$2y$10$C0OByt4QBhsf03.zPKj3S.tnzvWHD5ipomItmPZ.TDKFFl4siFfyy', 'pegawai', NULL, NULL, '2023-11-20 22:09:15', '2023-11-21 03:12:07'),
('f3e696bc-0076-4ae8-b210-64fc2aad9c1b', 'John Doe', '19210120@unima.ac.id', '123456', NULL, '$2y$10$ZEzz49Z83yVso.k9rW0aZ.fxdHvjREKArXf4UjRBz3UHMl/1Uo4te', 'pegawai', NULL, NULL, '2024-01-31 01:10:56', '2024-01-31 01:18:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arsip`
--
ALTER TABLE `arsip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berkas`
--
ALTER TABLE `berkas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bobot_subkriteria`
--
ALTER TABLE `bobot_subkriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_alternatif`
--
ALTER TABLE `detail_alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemberitahuan`
--
ALTER TABLE `pemberitahuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peninjauan_berkas`
--
ALTER TABLE `peninjauan_berkas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perankingan`
--
ALTER TABLE `perankingan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `periode_naik_pangkat`
--
ALTER TABLE `periode_naik_pangkat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
