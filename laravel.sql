-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Okt 2023 pada 07.40
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periode_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `arsip`
--

CREATE TABLE `arsip` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berkas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `berkas`
--

CREATE TABLE `berkas` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periode_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alternatif_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surat_pengantar_instansi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sk_cpns_pns` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kartu_pegawai` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sk_pangkat_akhir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sk_jabatan_akhir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ijazah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sk_kp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('dikirim','perbaikan','diterima') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bobot_kriteria`
--

CREATE TABLE `bobot_kriteria` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kriteria1` int(11) NOT NULL,
  `kriteria2` int(11) NOT NULL,
  `bobot` double NOT NULL DEFAULT 0,
  `eigen` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bobot_kriteria`
--

INSERT INTO `bobot_kriteria` (`id`, `kriteria1`, `kriteria2`, `bobot`, `eigen`, `created_at`, `updated_at`) VALUES
('18d87166-ba10-4bc9-9d18-a9a76837492d', 5, 5, 1, 0.076923076923077, '2023-08-29 02:26:50', '2023-08-29 02:42:55'),
('33b57cfd-f82d-4256-84cd-763fb290b271', 5, 4, 0.11111111111111, 0.09090909090909, '2023-08-29 02:26:50', '2023-08-29 02:42:55'),
('36f308d7-731f-4064-893e-46f2dbc86b20', 5, 6, 0.33333333333333, 0.032258064516129, '2023-08-29 02:27:03', '2023-08-29 02:42:55'),
('49b64ddd-c4f9-43e1-8a4e-758228bc6217', 4, 4, 1, 0.81818181818182, '2023-08-29 02:26:38', '2023-08-29 02:42:55'),
('577ec7be-c92f-4acd-b4d8-eef6dbe8a6b3', 6, 5, 3, 0.23076923076923, '2023-08-29 02:27:03', '2023-08-29 02:42:55'),
('72080712-a4e2-4a3a-b00a-6b3032e92e29', 4, 6, 9, 0.87096774193548, '2023-08-29 02:27:03', '2023-08-29 02:42:55'),
('9eef4a24-bbd5-4d68-84cb-0bd13e6065fc', 4, 5, 9, 0.69230769230769, '2023-08-29 02:26:50', '2023-08-29 02:42:55'),
('b8584b3c-01a5-4698-b7af-e86e4ae6b3cf', 6, 4, 0.11111111111111, 0.09090909090909, '2023-08-29 02:27:03', '2023-08-29 02:42:55'),
('e356d91c-004e-4236-8604-53b6a3fb2f9d', 6, 6, 1, 0.096774193548387, '2023-08-29 02:27:03', '2023-08-29 02:42:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bobot_subkriteria`
--

CREATE TABLE `bobot_subkriteria` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kriteria_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subkriteria_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kriteria1` int(11) NOT NULL,
  `kriteria2` int(11) NOT NULL,
  `bobot` double NOT NULL DEFAULT 0,
  `eigen` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bobot_subkriteria`
--

INSERT INTO `bobot_subkriteria` (`id`, `kriteria_id`, `subkriteria_id`, `kriteria1`, `kriteria2`, `bobot`, `eigen`, `created_at`, `updated_at`) VALUES
('02bb518d-a793-4366-90f2-8f32f697c3ca', '95aa79fa-2167-44b1-98bb-6c76a0b6c81e', '5d23daac-0f39-4bed-bdac-a66bc2ad82df', 10, 11, 7, 0.53030303030303, '2023-08-29 02:49:45', '2023-08-29 03:10:31'),
('0a679fd1-fe50-4f68-b760-ae2a85f6d7ca', '95aa79fa-2167-44b1-98bb-6c76a0b6c81e', '9acc306a-0e96-4b38-8b3c-138ac54fe0d0', 11, 12, 5, 0.3125, '2023-08-29 02:49:57', '2023-08-29 03:10:31'),
('0d548ef6-1ac8-4e32-89a6-1c3e4dce88a4', '11b93cb8-db72-4392-bf59-24aa0c9ea372', '33292848-361a-4c2b-aaf7-bd259cda4e1b', 2, 1, 0.14285714285714, 0.085227272727271, '2023-08-29 02:46:27', '2023-08-29 02:58:48'),
('147c0e78-adf4-4129-b4cc-eb223c572b10', '95aa79fa-2167-44b1-98bb-6c76a0b6c81e', 'b1a16d40-789e-4375-b8df-bfd9d0f1f0a6', 9, 10, 7, 0.8448275862069, '2023-08-29 02:49:29', '2023-08-29 03:10:31'),
('17e20fa4-617f-4d38-99b4-fe07a5074612', '95aa79fa-2167-44b1-98bb-6c76a0b6c81e', 'f8639522-11a5-4137-8607-1af1e0cbf746', 12, 11, 0.2, 0.015151515151515, '2023-08-29 02:49:57', '2023-08-29 03:10:31'),
('229faf62-22cc-42c3-a1e2-23ff1266bb05', 'eec9b398-2d8c-4f8a-ae11-55a40476ade1', '8db2dcdb-8f74-43ce-a58b-cb70414dbfba', 5, 8, 3, 0.1875, '2023-08-29 02:48:42', '2023-08-29 03:05:24'),
('2fcefe97-dac7-43e9-b087-7bf6321b3243', 'eec9b398-2d8c-4f8a-ae11-55a40476ade1', '8db2dcdb-8f74-43ce-a58b-cb70414dbfba', 5, 6, 7, 0.8448275862069, '2023-08-29 02:47:58', '2023-08-29 03:05:24'),
('32e6749b-8af7-40c0-a692-fb12a83a7868', '11b93cb8-db72-4392-bf59-24aa0c9ea372', '94fc7888-b426-4eb6-9c81-b03ed1972ffc', 3, 4, 5, 0.3125, '2023-08-29 02:47:02', '2023-08-29 02:58:48'),
('3486b77d-01f3-4bfc-bb41-b756a04d85ff', '11b93cb8-db72-4392-bf59-24aa0c9ea372', '9ea70acf-ef24-40bc-b90d-d84b8b172eee', 4, 4, 1, 0.0625, '2023-08-29 02:47:02', '2023-08-29 02:58:48'),
('380fe27f-49ee-4799-adbd-26a43d4aeee0', '11b93cb8-db72-4392-bf59-24aa0c9ea372', '9ea70acf-ef24-40bc-b90d-d84b8b172eee', 4, 1, 0.33333333333333, 0.19886363636364, '2023-08-29 02:47:02', '2023-08-29 02:58:48'),
('3b9e2900-9d6d-4705-904f-0bf9f7f154dc', '11b93cb8-db72-4392-bf59-24aa0c9ea372', '94fc7888-b426-4eb6-9c81-b03ed1972ffc', 3, 1, 0.2, 0.11931818181818, '2023-08-29 02:46:42', '2023-08-29 02:58:48'),
('3d55416a-033f-4dc7-9100-bb53ec3e6187', '95aa79fa-2167-44b1-98bb-6c76a0b6c81e', 'b1a16d40-789e-4375-b8df-bfd9d0f1f0a6', 9, 9, 1, 0.59659090909091, '2023-08-29 02:49:02', '2023-08-29 03:10:31'),
('3f527c4c-7b83-4c6a-80bd-ccb2fb4e8620', 'eec9b398-2d8c-4f8a-ae11-55a40476ade1', '56908e4d-7973-4b8a-8f06-241850c4be8f', 6, 7, 7, 0.53030303030303, '2023-08-29 02:48:25', '2023-08-29 03:05:24'),
('51e7aba3-b5b8-4b2d-9efd-3b5aa55152f8', '95aa79fa-2167-44b1-98bb-6c76a0b6c81e', '5d23daac-0f39-4bed-bdac-a66bc2ad82df', 10, 9, 0.14285714285714, 0.085227272727271, '2023-08-29 02:49:29', '2023-08-29 03:10:31'),
('54516f61-0026-4af6-a8fb-c1b6d31c9674', 'eec9b398-2d8c-4f8a-ae11-55a40476ade1', '56908e4d-7973-4b8a-8f06-241850c4be8f', 6, 5, 0.14285714285714, 0.085227272727271, '2023-08-29 02:47:58', '2023-08-29 03:05:24'),
('559e68a3-3c3c-469f-aa02-8528e1ec4580', 'eec9b398-2d8c-4f8a-ae11-55a40476ade1', '50c38a2a-29ea-4172-b225-e0ae92e5a477', 7, 8, 5, 0.3125, '2023-08-29 02:48:42', '2023-08-29 03:05:24'),
('5a2cd811-7a1a-41b8-b26b-ad9fcdfc9116', '95aa79fa-2167-44b1-98bb-6c76a0b6c81e', '5d23daac-0f39-4bed-bdac-a66bc2ad82df', 10, 10, 1, 0.12068965517241, '2023-08-29 02:49:28', '2023-08-29 03:10:31'),
('60ceb731-ae89-446d-960d-1b3cead412d9', '11b93cb8-db72-4392-bf59-24aa0c9ea372', 'c1bd95f2-aa13-4294-95d2-9e481271e391', 1, 4, 3, 0.1875, '2023-08-29 02:47:02', '2023-08-29 02:58:48'),
('67e087c2-969d-4025-ae79-9ac539efe71e', '11b93cb8-db72-4392-bf59-24aa0c9ea372', '94fc7888-b426-4eb6-9c81-b03ed1972ffc', 3, 2, 0.14285714285714, 0.017241379310344, '2023-08-29 02:46:42', '2023-08-29 02:58:48'),
('710a2711-3bbc-4a95-95e0-ddeb14e23169', '95aa79fa-2167-44b1-98bb-6c76a0b6c81e', 'f8639522-11a5-4137-8607-1af1e0cbf746', 12, 12, 1, 0.0625, '2023-08-29 02:49:57', '2023-08-29 03:10:31'),
('775b475a-1cca-4bc9-8cfa-9883c168006d', '11b93cb8-db72-4392-bf59-24aa0c9ea372', '33292848-361a-4c2b-aaf7-bd259cda4e1b', 2, 4, 7, 0.4375, '2023-08-29 02:47:02', '2023-08-29 02:58:48'),
('7847edc2-72e7-41fe-bc97-4a3bf2018d8c', '95aa79fa-2167-44b1-98bb-6c76a0b6c81e', 'b1a16d40-789e-4375-b8df-bfd9d0f1f0a6', 9, 11, 5, 0.37878787878788, '2023-08-29 02:49:45', '2023-08-29 03:10:31'),
('7b7e6eef-5693-4c67-aed8-d2317b6c67c5', 'eec9b398-2d8c-4f8a-ae11-55a40476ade1', '50c38a2a-29ea-4172-b225-e0ae92e5a477', 7, 5, 0.2, 0.11931818181818, '2023-08-29 02:48:25', '2023-08-29 03:05:24'),
('7cffb757-81e6-454b-ac84-bbd81074257b', '95aa79fa-2167-44b1-98bb-6c76a0b6c81e', '9acc306a-0e96-4b38-8b3c-138ac54fe0d0', 11, 10, 0.14285714285714, 0.017241379310344, '2023-08-29 02:49:45', '2023-08-29 03:10:31'),
('80443731-1ce0-4618-8a6f-7f58f2cebac1', '11b93cb8-db72-4392-bf59-24aa0c9ea372', 'c1bd95f2-aa13-4294-95d2-9e481271e391', 1, 2, 7, 0.8448275862069, '2023-08-29 02:46:27', '2023-08-29 02:58:48'),
('831dcbca-5df1-4379-9ca8-b3814ec62781', 'eec9b398-2d8c-4f8a-ae11-55a40476ade1', 'cd141b7d-0977-485d-b8a8-9fa3a3b0225c', 8, 6, 0.14285714285714, 0.017241379310344, '2023-08-29 02:48:42', '2023-08-29 03:05:24'),
('8e552a44-aa6f-42d4-8cf1-8bebeced4ca6', '95aa79fa-2167-44b1-98bb-6c76a0b6c81e', 'f8639522-11a5-4137-8607-1af1e0cbf746', 12, 10, 0.14285714285714, 0.017241379310344, '2023-08-29 02:49:57', '2023-08-29 03:10:31'),
('946cabdc-82e8-4f9e-b33a-3e8ecf406ede', 'eec9b398-2d8c-4f8a-ae11-55a40476ade1', 'cd141b7d-0977-485d-b8a8-9fa3a3b0225c', 8, 7, 0.2, 0.015151515151515, '2023-08-29 02:48:42', '2023-08-29 03:05:24'),
('a55836de-7a00-49d7-be3f-14c5449b56e8', '95aa79fa-2167-44b1-98bb-6c76a0b6c81e', 'f8639522-11a5-4137-8607-1af1e0cbf746', 12, 9, 0.33333333333333, 0.19886363636364, '2023-08-29 02:49:57', '2023-08-29 03:10:31'),
('acc3de95-cc82-44c6-bd65-82286cb124ae', 'eec9b398-2d8c-4f8a-ae11-55a40476ade1', '50c38a2a-29ea-4172-b225-e0ae92e5a477', 7, 7, 1, 0.075757575757576, '2023-08-29 02:48:25', '2023-08-29 03:05:24'),
('b2835710-8460-4c60-a9b2-b2e0f38e5813', 'eec9b398-2d8c-4f8a-ae11-55a40476ade1', '56908e4d-7973-4b8a-8f06-241850c4be8f', 6, 6, 1, 0.12068965517241, '2023-08-29 02:47:58', '2023-08-29 03:05:24'),
('b61fe1c5-06c6-4a23-89bb-07dbba5a0dc9', 'eec9b398-2d8c-4f8a-ae11-55a40476ade1', '50c38a2a-29ea-4172-b225-e0ae92e5a477', 7, 6, 0.14285714285714, 0.017241379310344, '2023-08-29 02:48:25', '2023-08-29 03:05:24'),
('c1ccc414-9958-4b2f-86aa-61907ad750fa', '11b93cb8-db72-4392-bf59-24aa0c9ea372', '9ea70acf-ef24-40bc-b90d-d84b8b172eee', 4, 3, 0.2, 0.015151515151515, '2023-08-29 02:47:02', '2023-08-29 02:58:48'),
('c6fd6857-d47d-4032-b1f3-7e938d512cfb', '95aa79fa-2167-44b1-98bb-6c76a0b6c81e', 'b1a16d40-789e-4375-b8df-bfd9d0f1f0a6', 9, 12, 3, 0.1875, '2023-08-29 02:49:57', '2023-08-29 03:10:31'),
('cd0033a9-42bd-417b-8c47-1a08ddfb0610', '11b93cb8-db72-4392-bf59-24aa0c9ea372', '33292848-361a-4c2b-aaf7-bd259cda4e1b', 2, 3, 7, 0.53030303030303, '2023-08-29 02:46:42', '2023-08-29 02:58:48'),
('cd2194c7-0510-4e3a-90bf-2b46121e23b2', '95aa79fa-2167-44b1-98bb-6c76a0b6c81e', '5d23daac-0f39-4bed-bdac-a66bc2ad82df', 10, 12, 7, 0.4375, '2023-08-29 02:49:57', '2023-08-29 03:10:31'),
('d1ad7c15-309e-41bd-a034-b5dfaec87724', 'eec9b398-2d8c-4f8a-ae11-55a40476ade1', '56908e4d-7973-4b8a-8f06-241850c4be8f', 6, 8, 7, 0.4375, '2023-08-29 02:48:42', '2023-08-29 03:05:24'),
('d2dca95d-e674-44df-aabb-ef47a9d2698e', '11b93cb8-db72-4392-bf59-24aa0c9ea372', '33292848-361a-4c2b-aaf7-bd259cda4e1b', 2, 2, 1, 0.12068965517241, '2023-08-29 02:46:27', '2023-08-29 02:58:48'),
('d2e026a7-aabf-441a-b683-2de2b18861c8', 'eec9b398-2d8c-4f8a-ae11-55a40476ade1', '8db2dcdb-8f74-43ce-a58b-cb70414dbfba', 5, 5, 1, 0.59659090909091, '2023-08-29 02:47:33', '2023-08-29 03:05:24'),
('d67c1517-1c4d-4288-a478-e3e87f106fb4', '11b93cb8-db72-4392-bf59-24aa0c9ea372', 'c1bd95f2-aa13-4294-95d2-9e481271e391', 1, 1, 1, 0.59659090909091, '2023-08-29 02:46:12', '2023-08-29 02:58:48'),
('e146f82e-b095-4c20-a8d4-9220a64533e7', '95aa79fa-2167-44b1-98bb-6c76a0b6c81e', '9acc306a-0e96-4b38-8b3c-138ac54fe0d0', 11, 9, 0.2, 0.11931818181818, '2023-08-29 02:49:45', '2023-08-29 03:10:31'),
('edeecea1-8cb4-4fba-aa4b-5dfc77fe4654', 'eec9b398-2d8c-4f8a-ae11-55a40476ade1', 'cd141b7d-0977-485d-b8a8-9fa3a3b0225c', 8, 5, 0.33333333333333, 0.19886363636364, '2023-08-29 02:48:42', '2023-08-29 03:05:24'),
('efc98932-7363-4b75-abd1-a65876c3d138', '95aa79fa-2167-44b1-98bb-6c76a0b6c81e', '9acc306a-0e96-4b38-8b3c-138ac54fe0d0', 11, 11, 1, 0.075757575757576, '2023-08-29 02:49:45', '2023-08-29 03:10:31'),
('f03bcdd8-ecce-4d53-8796-972b3c98925e', '11b93cb8-db72-4392-bf59-24aa0c9ea372', '9ea70acf-ef24-40bc-b90d-d84b8b172eee', 4, 2, 0.14285714285714, 0.017241379310344, '2023-08-29 02:47:02', '2023-08-29 02:58:48'),
('f49c8e92-839c-43f8-8896-f71d7aeabefc', '11b93cb8-db72-4392-bf59-24aa0c9ea372', 'c1bd95f2-aa13-4294-95d2-9e481271e391', 1, 3, 5, 0.37878787878788, '2023-08-29 02:46:42', '2023-08-29 02:58:48'),
('f5017e6f-019e-4851-b0b7-f970e2e3e8e0', '11b93cb8-db72-4392-bf59-24aa0c9ea372', '94fc7888-b426-4eb6-9c81-b03ed1972ffc', 3, 3, 1, 0.075757575757576, '2023-08-29 02:46:42', '2023-08-29 02:58:48'),
('fa176a1a-a8c3-4bcb-8655-483548f52987', 'eec9b398-2d8c-4f8a-ae11-55a40476ade1', 'cd141b7d-0977-485d-b8a8-9fa3a3b0225c', 8, 8, 1, 0.0625, '2023-08-29 02:48:42', '2023-08-29 03:05:24'),
('fbc4c1fd-921d-4005-8278-4ab21a3165fc', 'eec9b398-2d8c-4f8a-ae11-55a40476ade1', '8db2dcdb-8f74-43ce-a58b-cb70414dbfba', 5, 7, 5, 0.37878787878788, '2023-08-29 02:48:25', '2023-08-29 03:05:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_alternatif`
--

CREATE TABLE `detail_alternatif` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alternatif_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kriteria_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_kriteria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subkriteria_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_subkriteria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_bobot` double NOT NULL DEFAULT 0,
  `jumlah_eigen` double NOT NULL DEFAULT 0,
  `rata_eigen` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id`, `kode`, `nama`, `jumlah_bobot`, `jumlah_eigen`, `rata_eigen`, `created_at`, `updated_at`) VALUES
('11b93cb8-db72-4392-bf59-24aa0c9ea372', 4, 'Lamanya Masa Kerja', 1.2222222222222, 2.381457252425, 0.79381908414166, '2023-08-29 02:26:38', '2023-08-29 02:42:55'),
('95aa79fa-2167-44b1-98bb-6c76a0b6c81e', 6, 'Kinerja Pegawai', 10.333333333333, 0.41845251522671, 0.13948417174224, '2023-08-29 02:27:03', '2023-08-29 02:42:55'),
('eec9b398-2d8c-4f8a-ae11-55a40476ade1', 5, 'Kehadiran', 13, 0.2000902323483, 0.066696744116099, '2023-08-29 02:26:50', '2023-08-29 02:42:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
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
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nipl` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gelar_depan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gelar_belakang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gol_darah` enum('A','B','AB','O') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identitas_diri` enum('KTP','SIM','Paspor') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_identitas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `npwp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelurahan_desa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kab_kota` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_pos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama` enum('Islam','Kristen','Katholik','Hindu','Budha') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_pernikahan` enum('Singel','Menikah','Janda','Duda') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tinggi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `berat_badan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hobi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmt_bekerja_cpns` date DEFAULT NULL,
  `gol_ruang_awal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id`, `user_id`, `jabatan`, `nipl`, `gelar_depan`, `gelar_belakang`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `gol_darah`, `identitas_diri`, `nomor_identitas`, `npwp`, `alamat`, `kelurahan_desa`, `kecamatan`, `kab_kota`, `kode_pos`, `no_telp`, `agama`, `status_pernikahan`, `tinggi`, `berat_badan`, `hobi`, `tmt_bekerja_cpns`, `gol_ruang_awal`, `created_at`, `updated_at`) VALUES
('050be5cf-8408-4cc3-bc83-8ddf9d2aa294', '139e6eeb-421a-48dd-addd-d5afeac16531', 'Orang Biasa', '123', 'Tes.', 'S.Kompor', 'Tomohon', '1998-12-30', 'L', 'B', 'KTP', '8438472374627342349', '63463492348346347347', 'Contoh Alamat', 'Contoh Kelurahan', 'Contoh Kecamatan', 'Contoh Kota', '43234', '085677358211', 'Kristen', 'Singel', '120', '30', 'Tidak punya hobi', '2023-09-30', 'Contoh Golongan', '2023-09-30 06:39:07', '2023-09-30 20:31:22'),
('1c72ef9f-7d13-4a00-94ff-c68c12bcf409', 'cc08f2cf-da4c-4e32-9139-2d33f0025720', 'Pegawai', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-30 20:39:00', '2023-09-30 20:39:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemberitahuan`
--

CREATE TABLE `pemberitahuan` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dibaca` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('terdaftar_periode','rekomendasi_naik_pangkat','batal_rekomendasi_naik_pangkat','perbaikan_berkas','berkas_diterima','sk_kp_dikirim','semua_sk_kp_dikirim') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peninjauan_berkas`
--

CREATE TABLE `peninjauan_berkas` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periode_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alternatif_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('perbaikan','diterima') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `perankingan`
--

CREATE TABLE `perankingan` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periode_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alternatif_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` double NOT NULL DEFAULT 0,
  `direkomendasi` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `periode_naik_pangkat`
--

CREATE TABLE `periode_naik_pangkat` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('sementara','selesai') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kriteria_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_bobot` double NOT NULL DEFAULT 0,
  `jumlah_eigen` double NOT NULL DEFAULT 0,
  `rata_eigen` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id`, `kriteria_id`, `kode`, `nama`, `jumlah_bobot`, `jumlah_eigen`, `rata_eigen`, `created_at`, `updated_at`) VALUES
('33292848-361a-4c2b-aaf7-bd259cda4e1b', '11b93cb8-db72-4392-bf59-24aa0c9ea372', 2, 'Cukup Lama', 8.2857142857143, 1.1737199582027, 0.29342998955068, '2023-08-29 02:46:27', '2023-08-29 02:58:48'),
('50c38a2a-29ea-4172-b225-e0ae92e5a477', 'eec9b398-2d8c-4f8a-ae11-55a40476ade1', 7, 'Kehadiran Minimal', 13.2, 0.5248171368861, 0.13120428422152, '2023-08-29 02:48:25', '2023-08-29 03:05:24'),
('56908e4d-7973-4b8a-8f06-241850c4be8f', 'eec9b398-2d8c-4f8a-ae11-55a40476ade1', 6, 'Kehadiran Sebagian', 8.2857142857143, 1.1737199582027, 0.29342998955068, '2023-08-29 02:47:58', '2023-08-29 03:05:24'),
('5d23daac-0f39-4bed-bdac-a66bc2ad82df', '95aa79fa-2167-44b1-98bb-6c76a0b6c81e', 10, 'Baik', 8.2857142857143, 1.1737199582027, 0.29342998955068, '2023-08-29 02:49:28', '2023-08-29 03:10:31'),
('8db2dcdb-8f74-43ce-a58b-cb70414dbfba', 'eec9b398-2d8c-4f8a-ae11-55a40476ade1', 5, 'Kehadiran Penuh', 1.6761904761905, 2.0077063740857, 0.50192659352142, '2023-08-29 02:47:33', '2023-08-29 03:05:24'),
('94fc7888-b426-4eb6-9c81-b03ed1972ffc', '11b93cb8-db72-4392-bf59-24aa0c9ea372', 3, 'Lama', 13.2, 0.5248171368861, 0.13120428422152, '2023-08-29 02:46:42', '2023-08-29 02:58:48'),
('9acc306a-0e96-4b38-8b3c-138ac54fe0d0', '95aa79fa-2167-44b1-98bb-6c76a0b6c81e', 11, 'Cukup', 13.2, 0.5248171368861, 0.13120428422152, '2023-08-29 02:49:44', '2023-08-29 03:10:31'),
('9ea70acf-ef24-40bc-b90d-d84b8b172eee', '11b93cb8-db72-4392-bf59-24aa0c9ea372', 4, 'Baru', 16, 0.2937565308255, 0.073439132706375, '2023-08-29 02:47:02', '2023-08-29 02:58:48'),
('b1a16d40-789e-4375-b8df-bfd9d0f1f0a6', '95aa79fa-2167-44b1-98bb-6c76a0b6c81e', 9, 'Sangat Baik', 1.6761904761905, 2.0077063740857, 0.50192659352142, '2023-08-29 02:49:02', '2023-08-29 03:10:31'),
('c1bd95f2-aa13-4294-95d2-9e481271e391', '11b93cb8-db72-4392-bf59-24aa0c9ea372', 1, 'Sangat Lama', 1.6761904761905, 2.0077063740857, 0.50192659352142, '2023-08-29 02:46:12', '2023-08-29 02:58:48'),
('cd141b7d-0977-485d-b8a8-9fa3a3b0225c', 'eec9b398-2d8c-4f8a-ae11-55a40476ade1', 8, 'Kehadiran Tak Memadai', 16, 0.2937565308255, 0.073439132706375, '2023-08-29 02:48:42', '2023-08-29 03:05:24'),
('f8639522-11a5-4137-8607-1af1e0cbf746', '95aa79fa-2167-44b1-98bb-6c76a0b6c81e', 12, 'Kurang', 16, 0.2937565308255, 0.073439132706375, '2023-08-29 02:49:57', '2023-08-29 03:10:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','pegawai','bkpsdm') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `nip`, `email_verified_at`, `password`, `role`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
('139e6eeb-421a-48dd-addd-d5afeac16531', 'Refandi Andika Runtu', 'runtufandi@gmail.com', '16210019', NULL, '$2y$10$.fVyY7byn4hJZu7Zr6DsT.1k6eIUKUeaAf0wFQJtEg/fU1T4DPbXi', 'pegawai', NULL, NULL, '2023-09-30 06:39:07', '2023-09-30 20:31:22'),
('6b463ad6-cf74-4278-9657-35bfbe556b95', 'BKPSDM Minahasa', 'bkpsdmminahasa73@gmail.com', NULL, NULL, '$2y$10$.fVyY7byn4hJZu7Zr6DsT.1k6eIUKUeaAf0wFQJtEg/fU1T4DPbXi', 'bkpsdm', NULL, NULL, '2023-09-30 06:37:48', '2023-09-30 21:35:52'),
('89d4e096-9576-4417-a72f-85943301378f', 'Admin', 'dlhminahasa896@gmail.com', NULL, NULL, '$2y$10$.fVyY7byn4hJZu7Zr6DsT.1k6eIUKUeaAf0wFQJtEg/fU1T4DPbXi', 'admin', NULL, NULL, '2023-09-30 06:38:23', '2023-09-30 21:36:31'),
('cc08f2cf-da4c-4e32-9139-2d33f0025720', 'Regina Tambuwun', 'reginatambuwun123@gmail.com', '123456', NULL, '$2y$10$.fVyY7byn4hJZu7Zr6DsT.1k6eIUKUeaAf0wFQJtEg/fU1T4DPbXi', 'pegawai', NULL, NULL, '2023-09-30 20:39:00', '2023-09-30 20:39:00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `arsip`
--
ALTER TABLE `arsip`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `berkas`
--
ALTER TABLE `berkas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bobot_subkriteria`
--
ALTER TABLE `bobot_subkriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_alternatif`
--
ALTER TABLE `detail_alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemberitahuan`
--
ALTER TABLE `pemberitahuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peninjauan_berkas`
--
ALTER TABLE `peninjauan_berkas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `perankingan`
--
ALTER TABLE `perankingan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `periode_naik_pangkat`
--
ALTER TABLE `periode_naik_pangkat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
